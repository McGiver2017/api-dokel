<?php

namespace App\Http\Controllers\DocumentsElectronics\Invoice;

use App\Account;
use App\detail_invoice;
use App\Enterprise;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Identification;
use App\Office;
use App\Serie;
use App\Invoice as ModelTable;
use App\type_affectation_igv;
use App\type_document;
use App\leyend_office;
use App\leyend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Util;
use Greenter\Model\Company\Address;
use Greenter\Model\Company\Company;
use Greenter\Model\Client\Client;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;
use Greenter\Ws\Services\SunatEndpoints;
use DateTime;
class InvoiceController extends Controller
{

    public function examplegenerador($operacion){
        $invoice = self::processData();
        $empresa = Account::all()->random();
        switch ($operacion){
            case 'enviar': self::sendToSunat($invoice, $empresa); break;
            case 'mostrar': self::viewBoleta($invoice, $empresa); break;
            default: return response()->json(['error' => 'extension incorrecta. Solo se admite enviar o mostrar'], 500);
                break;
        }

    }
    public function generador($operacion, $id){
        $invoice = self::processData($id);
        $empresa = Account::all()->random();
        switch ($operacion){
            case 'enviar': self::sendToSunat($invoice, $empresa); break;
            case 'mostrar': self::viewBoleta($invoice, $empresa); break;
            default: return response()->json(['error' => 'extension incorrecta. Solo se admite enviar o mostrar'], 500);
                break;
        }

    }
    public function processData(){
        $util = Util::getInstance();
        $invoice = \App\Invoice::find(3);
        $detailInvoice = detail_invoice::where('invoice_id', $invoice->id)->get();
        //datos que se generar apartir de otros
        $office = Office::find($invoice->office_transmitter_id);
        $office_receiver = Office::find($invoice->office_receiver_id);
        $account = Account::find($invoice->user_id);
        $enterprise = Enterprise::find($office->enterprise_id);
        $enterprise_receiver = Enterprise::find($office_receiver->enterprise_id);
        // tipo de documento
        $identification_receiver = Identification::find($enterprise_receiver->identification_code);
        // serie
        $serie = null;
        switch ($invoice->type_document_code) {
            case '01':
                $serie = $invoice->office_transmitter->serie_factura;
                break;
            
            default:
                # code...
                break;
        }
        //compania
        $empresa = new Company();
        $empresa->setRuc($enterprise->ruc)
            ->setNombreComercial($enterprise->comertial_name)
            ->setRazonSocial($enterprise->razon_social)
            ->setAddress((new Address())
                ->setDireccion($office->direction));
        // Cliente
        $client = new Client();
        $client->setTipoDoc($identification_receiver->code)
            ->setNumDoc($enterprise_receiver->ruc)
            ->setRznSocial($enterprise_receiver->razon_social);
        // Venta
        $invoiceD = new Invoice();
        $invoiceD->setTipoDoc($invoice->type_document_code)
            ->setSerie($serie)
            ->setCorrelativo($invoice->documento_correlativo)
            ->setFechaEmision(new DateTime())
            ->setTipoMoneda($invoice->venta_tipoDeMoneda)
            ->setClient($client)
            ->setMtoOperGravadas($invoice->venta_opGravadas)
            ->setMtoOperExoneradas($invoice->venta_opExonerados)
            ->setMtoOperInafectas($invoice->venta_opNoOnerosas)
            ->setMtoIGV($invoice->venta_igv)
            ->setMtoImpVenta($invoice->venta_precioVenta)
            ->setCompany($util->getCompany());
        $items = self::createItems($detailInvoice);
        $legends = self::generarLeyends(leyend_office::where('office_id', $office->id)->get());
        $invoiceD->setDetails($items)
            ->setLegends($legends);
        return $invoiceD;
    }
    public function viewInvoice($id){
        $util = Util::getInstance();
        $invoice = \App\Invoice::find($id);
        $detailInvoice = detail_invoice::where('invoice_id', $invoice->id)->get();
        //datos que se generar apartir de otros
        $office = Office::find($invoice->office_transmitter_id);
        $office_receiver = Office::find($invoice->office_receiver_id);
        $account = Account::find($invoice->user_id);
        $enterprise = Enterprise::find($office->enterprise_id);
        $enterprise_receiver = Enterprise::find($office_receiver->enterprise_id);
        // tipo de documento
        $identification_receiver = Identification::find($enterprise_receiver->identification_code);
        // serie
        $serie = null;
        switch ($invoice->type_document_code) {
            case '01':
                $serie = $invoice->office_transmitter->serie_factura;
                break;
            
            default:
                # code...
                break;
        }
        //compania
        $empresa = new Company();
        $empresa->setRuc($enterprise->ruc)
            ->setNombreComercial($enterprise->comertial_name)
            ->setRazonSocial($enterprise->razon_social)
            ->setAddress((new Address())
                ->setDireccion($office->direction));
        // Cliente
        $client = new Client();
        $client->setTipoDoc($identification_receiver->code)
            ->setNumDoc($enterprise_receiver->ruc)
            ->setRznSocial($enterprise_receiver->razon_social);
        // Venta
        $invoiceD = new Invoice();
        $invoiceD->setTipoDoc($invoice->type_document_code)
            ->setSerie($serie)
            ->setCorrelativo($invoice->documento_correlativo)
            ->setFechaEmision(new DateTime())
            ->setTipoMoneda($invoice->venta_tipoDeMoneda)
            ->setClient($client)
            ->setMtoOperGravadas($invoice->venta_opGravadas)
            ->setMtoOperExoneradas($invoice->venta_opExonerados)
            ->setMtoOperInafectas($invoice->venta_opNoOnerosas)
            ->setMtoIGV($invoice->venta_igv)
            ->setMtoImpVenta($invoice->venta_precioVenta)
            ->setCompany($util->getCompany());
        $items = self::createItems($detailInvoice);
        $legends = self::generarLeyends(leyend_office::where('office_id', $office->id)->get());
        $invoiceD->setDetails($items)
            ->setLegends($legends);
        return $invoiceD;
    }
    public function generarLeyends($items) {
        $itemsS = [];
        foreach ($items as $item){
            $leyenda = leyend::where('code', $item->leyend_code)->first();
            $value = $leyenda->description;
            $legend = new Legend();
            $legend->setCode($item->leyend_code)
                ->setValue($value);
            $itemsS[] =  $legend;
        }
        return $itemsS;
    }
    public function createItems($items){
        $itemsS = [];
        foreach ($items as $item){
            $itemDetail = new SaleDetail();
            $itemDetail->setCodProducto($item->code_product)
                ->setUnidad('NIU')
                ->setCantidad($item->quantity)
                ->setDescripcion($item->description)
                ->setIgv($item->igv)
                ->setTipAfeIgv($item->type_affectation_igv->code)
                ->setMtoValorVenta($item->AmountValueSale)
                ->setMtoValorUnitario($item->amountValueUnit)
                ->setMtoPrecioUnitario($item->AmountPriceUnit);
            $itemsS[] =  $itemDetail;
        }
        return $itemsS;
    }
    public function sendToSunat ($invoice, $empresa){
        $util = Util::getInstance();

// Envio a SUNAT.
        $see = $util->getSee(SunatEndpoints::FE_BETA, $empresa);
        $res = $see->send($invoice);
        Util::writeXml($invoice, $see->getFactory()->getLastXml());

        if ($res->isSuccess()) {
            /**@var $res \Greenter\Model\Response\BillResult*/
            $cdr = $res->getCdrResponse();
            Util::writeCdr($invoice, $res->getCdrZip());

            echo $util->getResponseFromCdr($cdr);
        } else {
            var_dump($res->getError());
        }
    }
    public function viewBoleta($invoice, $empresa){
        $util = Util::getInstance();
        try {
            $pdf = $util->getPdf($invoice, $empresa);
            $util->showPdf($pdf, $invoice->getName().'.pdf');
        } catch (Exception $e) {
            var_dump($e);
        }
    }
    public function index(){
        $facturas = \App\Invoice::get();
        return InvoiceResource::collection(\App\Invoice::all());
        return response()->json(['data' => $facturas]);
    }
    public function store(Request $request)
    {
        $cliente = $request->cliente;
        $codDoc = $cliente['tipoDocumento'];
        $venta = $request->datosCalculados;
        $usuario = auth()->user();
        $items = $request->productsTable;
        $oficina = $request->oficina;
        if($oficina==null){
            $cuenta = Account::where('user_id', $usuario->id)->first();
            $oficina = Office::where('enterprise_id', $cuenta->enterprise_id)->first();
            $oficina = $oficina->id;
        }
        $documentos = \App\Invoice::where('office_transmitter_id', $oficina)->where('type_document_code', $codDoc)->get();
        $correlativo = count($documentos);
        $officina_creador = office::find($oficina);

        // --- 
        $serie = null;
        switch ($codDoc) {
            case '01':
                $serie = $officina_creador->serie_factura;
                break;
            case '03':
            $serie = $officina_creador->serie_boleta;
            break;            
            default:
                $serie = $officina_creador->serie_factura;
                break;
        }
        // ---
        $Documento = [
            'user_id' => $usuario->id,
            'office_transmitter_id' => $oficina,
            'office_receiver_id' => $cliente['direccion'],
            'type_document_code' => $codDoc,
            'documento_correlativo' => $correlativo + 1,
            'documento_fechaEmision' => new DateTime(),
            'serie' => $serie,
            'venta_igv' => $venta['IGV'],
            'venta_opExonerados' => $venta['OpExoneradas'],
            'venta_descuentoOpGravadas' => $venta['descuentoOpGravadas'],
            'venta_opGravadas' => $venta['opGravadas'],
            'venta_opNoOnerosas' => $venta['opNoOnerosa'],
            'venta_valorDescuento' => $venta['descuentoOpGravadas'],
            'venta_tipoDeMoneda' => 'PEN',
            'venta_precioVenta' => $venta['precioVenta'],
            'venta_leyenda' => 'leyenda'
        ];

        $crear = modelTable::create($Documento);
        $typeAfecctation = \App\type_affectation_igv::all()->random();
        foreach ($items as $item) {
            $fila = [
                'invoice_id' => $crear->id,
                'code_product' => $item['codProducto'],
                'unity' => $item['cantidad'],
                'quantity' => $item['cantidad'],
                'description' => $item['descripcion'],
                'type_affectation_igv_code' => $item['tipoImpuesto'],
                'igv' => $item['igv'],
                'AmountValueSale' => $item['precioVenta'],
                'amountValueUnit' => $item['valorUnitario'],
                'AmountPriceUnit' => $item['precioUnitario']
            ];
            $guardar = detail_invoice::create($fila);
        }
        return response()->json(['data' => $crear]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tipo)
    {
        return InvoiceResource::collection(\App\Invoice::where('type_document_code',$tipo)->get());
        return response()->json(['data' => $facturas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
