<?php

namespace App\Http\Controllers\IniciarSistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\type_document;
use App\Identification;
use App\type_affectation_igv;
use App\type_notes_credit_debit;
use App\leyend;
use App\User;
use DB;
class GeneradorDatosBasicos extends Controller
{
    
    public $TipoDeDocumentos = [
        ['code' => '01','description' => 'FACTURA', 'UN 1001-Document Name' => '380'],
        ['code' => '03','description' => 'BOLETA DE VENTA', 'UN 1001-Document Name' => '346'],
        ['code' => '07','description' => 'NOTA DE CREDITO', 'UN 1001-Document Name' => '381'],
        ['code' => '08','description' => 'NOTA DE DEBITO', 'UN 1001-Document Name' => '383'],
        ['code' => '09','description' => 'GUIA DE REMISIÓN REMITENTE'],
        ['code' => '12','description' => 'TICKET DE MAQUINA REGISTRADORA'],
        ['code' => '13','description' => 'DOCUMENTO EMITIDO POR BANCOS, INSTITUCIONES FINANCIERAS, CREDITICIAS Y DE SEGUROS QUE SE ENCUENTREN BAJO EL CONTROL DE LA SUPERINTENDENCIA DE BANCA Y SEGUROS'],
        ['code' => '14','description' => 'RECIBO SERVICIOS PUBLICOS'],
        ['code' => '18','description' => 'DOCUMENTOS EMITIDOS POR LAS AFP'],
        ['code' => '31','description' => 'GUIA DE REMISIÓN TRANSPORTISTA'],
        ['code' => '56','description' => 'COMPROBANTE DE PAGO SEAE'],
        ['code' => '71','description' => 'GUIA DE REMISIÓN REMITENTE COMPLEMENTARIA'],                
        ['code' => '72','description' => 'GUIA DE REMISION TRANSPORTISTA COMPLEMENTARIA'],
    ];
    public $tiposDocumentoDeIdentidad = [
        ['code' => '0','description' => 'DOC.TRIB.NO.DOM.SIN.RUC'],
        ['code' => '1','description' => 'DOC. NACIONAL DE IDENTIDAD'],
        ['code' => '4','description' => 'CARNET DE EXTRANJERIA'],
        ['code' => '6','description' => 'REG. UNICO DE CONTRIBUYENTES'],
        ['code' => '7','description' => 'PASAPORTE'],
        ['code' => 'A','description' => 'CED. DIPLOMATICA DE IDENTIDAD'],
    ];
    public $tipoAfectoDeIgv = [
        ['code' => '10','description' => 'Gravado - Operación Onerosa'],
        ['code' => '11','description' => 'Gravado – Retiro por premio'],
        ['code' => '12','description' => 'Gravado – Retiro por donación'],
        ['code' => '13','description' => 'Gravado – Retiro '],
        ['code' => '14','description' => 'Gravado – Retiro por publicidad'],
        ['code' => '15','description' => 'Gravado – Bonificaciones'],
        ['code' => '16','description' => 'Gravado – Retiro por entrega a trabajadores'],
        ['code' => '17','description' => 'Gravado – IVAP'],
        ['code' => '20','description' => 'Exonerado - Operación Onerosa'],
        ['code' => '21','description' => 'Exonerado – Transferencia Gratuita'],
        ['code' => '30','description' => 'Inafecto - Operación Onerosa'],
        ['code' => '31','description' => 'Inafecto – Retiro por Bonificación'],
        ['code' => '32','description' => 'Inafecto – Retiro'],
        ['code' => '33','description' => 'Inafecto – Retiro por Muestras Médicas'],
        ['code' => '34','description' => 'Inafecto - Retiro por Convenio Colectivo'],
        ['code' => '35','description' => 'Inafecto – Retiro por premio'],
        ['code' => '36','description' => 'Inafecto - Retiro por publicidad'],
        ['code' => '40','description' => 'Exportación'],
    ];
    public $tipoNotaCreditoDebito = [
        ['type_document_code' => '07', 'code' => '01','description' => 'Anulación de la operación'],
        ['type_document_code' => '07', 'code' => '02','description' => 'Anulación por error en el RUC'],
        ['type_document_code' => '07', 'code' => '03','description' => 'Corrección por error en la descripción'],
        ['type_document_code' => '07', 'code' => '04','description' => 'Descuento global'],
        ['type_document_code' => '07', 'code' => '05','description' => 'Descuento por ítem'],
        ['type_document_code' => '07', 'code' => '06','description' => 'Devolución total'],
        ['type_document_code' => '07', 'code' => '07','description' => 'Devolución por ítem'],
        ['type_document_code' => '07', 'code' => '08','description' => 'Bonificación'],
        ['type_document_code' => '07', 'code' => '09','description' => 'Disminución en el valor'],
        ['type_document_code' => '07', 'code' => '10','description' => 'Otros Conceptos'],
        ['type_document_code' => '08', 'code' => '01','description' => 'Intereses por mora'],
        ['type_document_code' => '08', 'code' => '02','description' => 'Aumento en el valor'],
        ['type_document_code' => '08', 'code' => '03','description' => 'Penalidades/ otros conceptos'],
    ];
    public $leyend = [
        ['code' => '1000','description' => 'Monto en Letras'],
        ['code' => '1002','description' => 'Leyenda "TRANSFERENCIA GRATUITA DE UN BIEN Y/O SERVICIO PRESTADO GRATUITAMENTE"'],
        ['code' => '2000','description' => 'Leyenda “COMPROBANTE DE PERCEPCIÓN”'],
        ['code' => '2001','description' => 'Leyenda “BIENES TRANSFERIDOS EN LA AMAZONÍA REGIÓN SELVAPARA SER CONSUMIDOS EN LA MISMA"'],
        ['code' => '2002','description' => 'Leyenda “SERVICIOS PRESTADOS EN LA AMAZONÍA REGIÓN SELVA PARA SER CONSUMIDOS EN LA MISMA”'],
        ['code' => '2003','description' => 'Leyenda “CONTRATOS DE CONSTRUCCIÓN EJECUTADOS EN LA AMAZONÍA REGIÓN
        SELVA”'],
        ['code' => '2004','description' => 'Leyenda “Agencia de Viaje - Paquete turístico”'],
        ['code' => '2005','description' => 'Leyenda “Venta realizada por emisor itinerante”'],
        ['code' => '2006','description' => 'Leyenda: Operación sujeta a detracción'],
        ['code' => '2007','description' => 'Leyenda: Operación sujeta a IVAP'],
        ['code' => '3000','description' => 'Detracciones: CODIGO DE BB Y SS SUJETOS A DETRACCION'],
        ['code' => '3001','description' => 'Detracciones: NUMERO DE CTA EN EL BN'],
        ['code' => '3002','description' => 'Detracciones: Recursos Hidrobiológicos-Nombre y matrícula de la embarcación'],
        ['code' => '3003','description' => 'Detracciones: Recursos Hidrobiológicos-Tipo y cantidad de especie vendida'],
        ['code' => '3004','description' => 'Detracciones: Recursos Hidrobiológicos -Lugar de descarga'],
        ['code' => '3005','description' => 'Detracciones: Recursos Hidrobiológicos -Fecha de descarga'],
        ['code' => '3006','description' => 'Detracciones: Transporte Bienes vía terrestre – Numero Registro MTC'],
        ['code' => '3007','description' => 'Detracciones: Transporte Bienes vía terrestre – configuración vehicular'],
        ['code' => '3008','description' => 'Detracciones: Transporte Bienes vía terrestre – punto de origen'],
        ['code' => '3009','description' => 'Detracciones: Transporte Bienes vía terrestre – punto destino'],
        ['code' => '3010','description' => 'Detracciones: Transporte Bienes vía terrestre – valor referencial preliminar'],
        ['code' => '4000','description' => 'Beneficio hospedajes: Código País de emisión del pasaporte'],
        ['code' => '4001','description' => 'Beneficio hospedajes: Código País de residencia del sujeto no domiciliado'],
        ['code' => '4002','description' => 'Beneficio Hospedajes: Fecha de ingreso al país '],
        ['code' => '4003','description' => 'Beneficio Hospedajes: Fecha de ingreso al establecimiento'],
        ['code' => '4004','description' => 'Beneficio Hospedajes: Fecha de salida del establecimiento'],
        ['code' => '4005','description' => 'Beneficio Hospedajes: Número de días de permanencia'],
        ['code' => '4006','description' => 'Beneficio Hospedajes: Fecha de consumo '],
        ['code' => '4007','description' => 'Beneficio Hospedajes: Paquete turístico - Nombres y Apellidos del Huésped'],
        ['code' => '4008','description' => 'Beneficio Hospedajes: Paquete turístico – Tipo documento identidad del huésped'],
        ['code' => '4009','description' => 'Beneficio Hospedajes: Paquete turístico – Numero de documento identidad de huésped'],
        ['code' => '5000','description' => 'Proveedores Estado: Número de Expediente'],
        ['code' => '5001','description' => 'Proveedores Estado : Código de unidad ejecutora'],
        ['code' => '5002','description' => 'Proveedores Estado : N° de proceso de selección'],
        ['code' => '5003','description' => 'Proveedores Estado : N° de contrato'],
        ['code' => '6000','description' => 'Comercialización de Oro : Código Unico Concesión Minera'],
        ['code' => '6001','description' => 'Comercialización de Oro : N° declaración compromiso'],
        ['code' => '6002','description' => 'Comercialización de Oro : N° Reg. Especial .Comerci. Oro'],
        ['code' => '6003','description' => 'Comercialización de Oro : N° Resolución que autoriza Planta de Beneficio'],
        ['code' => '6004','description' => 'Comercialización de Oro : Ley Mineral (% concent. oro)'],
    ];
    public function generar () {        
        self::generarDatosTipoDocumentos();
        self::generarDatosTipoDocumentosDeIdentidad();
        self::generarDatosTipoAfectoDeIgv();
        self::generarDatosTipoNotaCreditoDebito();
        self::generarDatosLeyend();
        return 'terminado';
    }
    public function generarDatosTipoDocumentos() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        type_document::truncate();
        foreach($this->TipoDeDocumentos as $fila){
            type_document::create($fila);
        }
        return type_document::get();

    }
    public function generarDatosTipoDocumentosDeIdentidad() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Identification::truncate();
        foreach($this->tiposDocumentoDeIdentidad as $fila){
            Identification::create($fila);
        }
        return Identification::get();
    }
    public function generarDatosTipoAfectoDeIgv() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        type_affectation_igv::truncate();
        foreach($this->tipoAfectoDeIgv as $fila){
            type_affectation_igv::create($fila);
        }
        return type_affectation_igv::get();
    }
    public function generarDatosTipoNotaCreditoDebito() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        type_notes_credit_debit::truncate();
        foreach($this->tipoNotaCreditoDebito as $fila){
            type_notes_credit_debit::create($fila);
        }
        return type_notes_credit_debit::get();
    }
    public function generarDatosLeyend() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        leyend::truncate();
        foreach($this->leyend as $fila){
            leyend::create($fila);
        }
        return leyend::get();
    }
}
