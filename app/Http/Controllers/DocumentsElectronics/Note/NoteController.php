<?php

namespace App\Http\Controllers\DocumentsElectronics\Note;


use App\motive_note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use App\detail_invoice;
use App\Enterprise;
use App\Identification;
use App\Office;
use App\Serie;
use App\type_affectation_igv;
use App\Util;
use Greenter\Model\Company\Address;
use Greenter\Model\Company\Company;
use Greenter\Model\Client\Client;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;
use Greenter\Ws\Services\SunatEndpoints;
use DateTime;
use Greenter\Model\Sale\Note;
class NoteController extends Controller
{
    public function examplegenerador($operacion){
        $note = self::processData();
        $empresa = Account::all()->random();
        switch ($operacion){
            case 'enviar': self::sendToSunat($note, $empresa); break;
            case 'mostrar': self::viewBoleta($note, $empresa); break;
            default: return response()->json(['error' => 'extension incorrecta. Solo se admite enviar o mostrar'], 500);
                break;
        }

    }
    public function processData(){
        $util = Util::getInstance();
        $notes = \App\note::all()->random();
        $invoice = \App\Invoice::find($notes->invoice_id);
        $detailInvoice = detail_invoice::where('invoice_id', $invoice->id)->get();
        //datos que se generar apartir de otros
        $office = Office::find($invoice->office_transmitter_id);
        $office_receiver = Office::find($invoice->office_receiver_id);
        $account = Account::find($invoice->user_id);
        $enterprise = Enterprise::find($office->enterprise_id);
        $enterprise_receiver = Enterprise::find($office_receiver->enterprise_id);
        // tipo de documento
        $identification_receiver = Identification::find($enterprise_receiver->identification_id);
        $serie = Serie::find($invoice->serie_id);
        $serieNote = Serie::find($notes->serie_id);
        $motive = motive_note::find($notes->motive_note_id);
        //compania
        $empresa = new Company();
        $empresa->setRuc($enterprise->ruc)
            ->setNombreComercial($enterprise->comertial_name)
            ->setRazonSocial($enterprise->razon_social)
            ->setAddress((new Address())
                ->setDireccion($office->direction));
        // Cliente
        $client = new Client();
        $client->setTipoDoc($identification_receiver->codigo)
            ->setNumDoc($enterprise_receiver->ruc)
            ->setRznSocial($enterprise_receiver->razon_social);
        // Venta
        $note = new Note();
        $note
            ->setTipDocAfectado($serie->code_type_document)
            ->setNumDocfectado($serie->serie.'-'.$invoice->documento_correlativo)
            ->setCodMotivo($motive->code)
            ->setDesMotivo($motive->description)
            ->setTipoDoc('08')//$serieNote->code_type_document
            ->setSerie('FF01')//$serieNote->serie
            ->setFechaEmision(new DateTime())
            ->setCorrelativo('123')//$serieNote->documento_correlativo
            ->setTipoMoneda($invoice->venta_tipoDeMoneda)
            ->setClient($client)
            ->setMtoOperGravadas($invoice->venta_opGravadas)
            ->setMtoOperExoneradas($invoice->venta_opExonerados)
            ->setMtoOperInafectas($invoice->venta_opNoOnerosas)
            ->setMtoIGV(36)
            ->setMtoImpVenta($invoice->venta_igv)
            ->setCompany($util->getCompany());
        $items = self::createItems($detailInvoice);
        $legend = new Legend();
        $legend->setCode('1000')
            ->setValue($invoice->venta_leyenda);
        $note->setDetails($items)
            ->setLegends([$legend]);
        return $note;
    }
    public function createItems($items){
        $itemsS = [];
        foreach ($items as $item){
            $type_affectation_igv = type_affectation_igv::find($item->type_affectation_igv_id);
            $itemDetail = new SaleDetail();
            $itemDetail->setCodProducto($item->code_product)
                ->setUnidad('NIU')
                ->setCantidad($item->quantity)
                ->setDescripcion($item->description)
                ->setIgv($item->igv)
                ->setTipAfeIgv($type_affectation_igv->code)
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
