<?php

/* notadb.xml.twig */
class __TwigTemplate_0358d546333e9b97ee6682bf75fee0db948ca432762d3eb61b79253d2e03e34c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"no\"?>
<DebitNote xmlns=\"urn:oasis:names:specification:ubl:schema:xsd:DebitNote-2\"
           xmlns:cac=\"urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2\"
           xmlns:cbc=\"urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2\"
           xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\"
           xmlns:ext=\"urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2\"
           xmlns:sac=\"urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1\">
    <ext:UBLExtensions>
        <ext:UBLExtension>
            <ext:ExtensionContent>
                <sac:AdditionalInformation>
                    ";
        // line 12
        if ($this->getAttribute(($context["doc"] ?? null), "mtoOperGravadas", array())) {
            // line 13
            echo "<sac:AdditionalMonetaryTotal>
                            <cbc:ID>1001</cbc:ID>
                            <cbc:PayableAmount currencyID=\"";
            // line 15
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoOperGravadas", array())));
            echo "</cbc:PayableAmount>
                        </sac:AdditionalMonetaryTotal>
                    ";
        }
        // line 18
        if ($this->getAttribute(($context["doc"] ?? null), "mtoOperInafectas", array())) {
            // line 19
            echo "<sac:AdditionalMonetaryTotal>
                            <cbc:ID>1002</cbc:ID>
                            <cbc:PayableAmount currencyID=\"";
            // line 21
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoOperInafectas", array())));
            echo "</cbc:PayableAmount>
                        </sac:AdditionalMonetaryTotal>
                    ";
        }
        // line 24
        if ($this->getAttribute(($context["doc"] ?? null), "mtoOperExoneradas", array())) {
            // line 25
            echo "<sac:AdditionalMonetaryTotal>
                            <cbc:ID>1003</cbc:ID>
                            <cbc:PayableAmount currencyID=\"";
            // line 27
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoOperExoneradas", array())));
            echo "</cbc:PayableAmount>
                        </sac:AdditionalMonetaryTotal>
                    ";
        }
        // line 30
        if ($this->getAttribute(($context["doc"] ?? null), "perception", array())) {
            // line 31
            $context["perc"] = $this->getAttribute(($context["doc"] ?? null), "perception", array());
            // line 32
            echo "<sac:AdditionalMonetaryTotal>
                            <cbc:ID schemeID=\"";
            // line 33
            echo $this->getAttribute(($context["perc"] ?? null), "codReg", array());
            echo "\">2001</cbc:ID>
                            <sac:ReferenceAmount currencyID=\"PEN\">";
            // line 34
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["perc"] ?? null), "mtoBase", array())));
            echo "</sac:ReferenceAmount>
                            <cbc:PayableAmount currencyID=\"PEN\">";
            // line 35
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["perc"] ?? null), "mto", array())));
            echo "</cbc:PayableAmount>
                            <sac:TotalAmount currencyID=\"PEN\">";
            // line 36
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["perc"] ?? null), "mtoTotal", array())));
            echo "</sac:TotalAmount>
                        </sac:AdditionalMonetaryTotal>
                        <sac:AdditionalProperty>
                            <cbc:ID>2000</cbc:ID>
                            <cbc:Value>COMPROBANTE DE PERCEPCION</cbc:Value>
                        </sac:AdditionalProperty>
                    ";
        }
        // line 43
        if ($this->getAttribute(($context["doc"] ?? null), "mtoOperGratuitas", array())) {
            // line 44
            echo "<sac:AdditionalMonetaryTotal>
                            <cbc:ID>1004</cbc:ID>
                            <cbc:PayableAmount currencyID=\"";
            // line 46
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoOperGratuitas", array())));
            echo "</cbc:PayableAmount>
                        </sac:AdditionalMonetaryTotal>
                    ";
        }
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["doc"] ?? null), "legends", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["leg"]) {
            // line 50
            echo "<sac:AdditionalProperty>
                            <cbc:ID>";
            // line 51
            echo $this->getAttribute($context["leg"], "code", array());
            echo "</cbc:ID>
                            <cbc:Value>";
            // line 52
            echo $this->getAttribute($context["leg"], "value", array());
            echo "</cbc:Value>
                        </sac:AdditionalProperty>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['leg'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        echo "</sac:AdditionalInformation>
            </ext:ExtensionContent>
        </ext:UBLExtension>
        <ext:UBLExtension>
            <ext:ExtensionContent/>
        </ext:UBLExtension>
    </ext:UBLExtensions>
    <cbc:UBLVersionID>2.0</cbc:UBLVersionID>
    <cbc:CustomizationID>1.0</cbc:CustomizationID>
    <cbc:ID>";
        // line 64
        echo $this->getAttribute(($context["doc"] ?? null), "serie", array());
        echo "-";
        echo $this->getAttribute(($context["doc"] ?? null), "correlativo", array());
        echo "</cbc:ID>
    <cbc:IssueDate>";
        // line 65
        echo twig_date_format_filter($this->env, $this->getAttribute(($context["doc"] ?? null), "fechaEmision", array()), "Y-m-d");
        echo "</cbc:IssueDate>
    <cbc:IssueTime>";
        // line 66
        echo twig_date_format_filter($this->env, $this->getAttribute(($context["doc"] ?? null), "fechaEmision", array()), "H:i:s");
        echo "</cbc:IssueTime>
    <cbc:DocumentCurrencyCode>";
        // line 67
        echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
        echo "</cbc:DocumentCurrencyCode>
    <cac:DiscrepancyResponse>
        <cbc:ReferenceID>";
        // line 69
        echo $this->getAttribute(($context["doc"] ?? null), "numDocfectado", array());
        echo "</cbc:ReferenceID>
        <cbc:ResponseCode>";
        // line 70
        echo $this->getAttribute(($context["doc"] ?? null), "codMotivo", array());
        echo "</cbc:ResponseCode>
        <cbc:Description>";
        // line 71
        echo $this->getAttribute(($context["doc"] ?? null), "desMotivo", array());
        echo "</cbc:Description>
    </cac:DiscrepancyResponse>
    <cac:BillingReference>
        <cac:InvoiceDocumentReference>
            <cbc:ID>";
        // line 75
        echo $this->getAttribute(($context["doc"] ?? null), "numDocfectado", array());
        echo "</cbc:ID>
            <cbc:DocumentTypeCode>";
        // line 76
        echo $this->getAttribute(($context["doc"] ?? null), "tipDocAfectado", array());
        echo "</cbc:DocumentTypeCode>
        </cac:InvoiceDocumentReference>
    </cac:BillingReference>
    ";
        // line 79
        if ($this->getAttribute(($context["doc"] ?? null), "relDocs", array())) {
            // line 80
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["doc"] ?? null), "relDocs", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["rel"]) {
                // line 81
                echo "<cac:AdditionalDocumentReference>
        <cbc:ID>";
                // line 82
                echo $this->getAttribute($context["rel"], "nroDoc", array());
                echo "</cbc:ID>
        <cbc:DocumentTypeCode>";
                // line 83
                echo $this->getAttribute($context["rel"], "tipoDoc", array());
                echo "</cbc:DocumentTypeCode>
    </cac:AdditionalDocumentReference>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rel'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 87
        $context["emp"] = $this->getAttribute(($context["doc"] ?? null), "company", array());
        // line 88
        echo "<cac:Signature>
        <cbc:ID>";
        // line 89
        echo $this->getAttribute(($context["emp"] ?? null), "ruc", array());
        echo "</cbc:ID>
        <cbc:Note>GREENTER Builder</cbc:Note>
        <cac:SignatoryParty>
            <cac:PartyIdentification>
                <cbc:ID>";
        // line 93
        echo $this->getAttribute(($context["emp"] ?? null), "ruc", array());
        echo "</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[";
        // line 96
        echo $this->getAttribute(($context["emp"] ?? null), "nombreComercial", array());
        echo "]]></cbc:Name>
            </cac:PartyName>
        </cac:SignatoryParty>
        <cac:DigitalSignatureAttachment>
            <cac:ExternalReference>
                <cbc:URI>#SIGN-GREEN</cbc:URI>
            </cac:ExternalReference>
        </cac:DigitalSignatureAttachment>
    </cac:Signature>
    <cac:AccountingSupplierParty>
        <cbc:CustomerAssignedAccountID>";
        // line 106
        echo $this->getAttribute(($context["emp"] ?? null), "ruc", array());
        echo "</cbc:CustomerAssignedAccountID>
        <cbc:AdditionalAccountID>6</cbc:AdditionalAccountID>
        <cac:Party>
            <cac:PartyName>
                <cbc:Name><![CDATA[";
        // line 110
        echo $this->getAttribute(($context["emp"] ?? null), "nombreComercial", array());
        echo "]]></cbc:Name>
            </cac:PartyName>
            ";
        // line 112
        $context["addr"] = $this->getAttribute(($context["emp"] ?? null), "address", array());
        // line 113
        echo "<cac:PostalAddress>
                <cbc:ID>";
        // line 114
        echo $this->getAttribute(($context["addr"] ?? null), "ubigueo", array());
        echo "</cbc:ID>
                <cbc:StreetName><![CDATA[";
        // line 115
        echo $this->getAttribute(($context["addr"] ?? null), "direccion", array());
        echo "]]></cbc:StreetName>
                <cbc:CityName>";
        // line 116
        echo $this->getAttribute(($context["addr"] ?? null), "departamento", array());
        echo "</cbc:CityName>
                <cbc:CountrySubentity>";
        // line 117
        echo $this->getAttribute(($context["addr"] ?? null), "provincia", array());
        echo "</cbc:CountrySubentity>
                <cbc:District>";
        // line 118
        echo $this->getAttribute(($context["addr"] ?? null), "distrito", array());
        echo "</cbc:District>
                <cac:Country>
                    <cbc:IdentificationCode>";
        // line 120
        echo $this->getAttribute(($context["addr"] ?? null), "codigoPais", array());
        echo "</cbc:IdentificationCode>
                </cac:Country>
            </cac:PostalAddress>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[";
        // line 124
        echo $this->getAttribute(($context["emp"] ?? null), "razonSocial", array());
        echo "]]></cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingSupplierParty>
    ";
        // line 128
        $context["client"] = $this->getAttribute(($context["doc"] ?? null), "client", array());
        // line 129
        echo "<cac:AccountingCustomerParty>
        <cbc:CustomerAssignedAccountID>";
        // line 130
        echo $this->getAttribute(($context["client"] ?? null), "numDoc", array());
        echo "</cbc:CustomerAssignedAccountID>
        <cbc:AdditionalAccountID>";
        // line 131
        echo $this->getAttribute(($context["client"] ?? null), "tipoDoc", array());
        echo "</cbc:AdditionalAccountID>
        <cac:Party>
            ";
        // line 133
        if ($this->getAttribute(($context["client"] ?? null), "address", array())) {
            // line 134
            $context["addr"] = $this->getAttribute(($context["client"] ?? null), "address", array());
            // line 135
            echo "<cac:PostalAddress>
                <cbc:ID>";
            // line 136
            echo $this->getAttribute(($context["addr"] ?? null), "ubigueo", array());
            echo "</cbc:ID>
                <cbc:StreetName><![CDATA[";
            // line 137
            echo $this->getAttribute(($context["addr"] ?? null), "direccion", array());
            echo "]]></cbc:StreetName>
                <cac:Country>
                    <cbc:IdentificationCode>";
            // line 139
            echo $this->getAttribute(($context["addr"] ?? null), "codigoPais", array());
            echo "</cbc:IdentificationCode>
                </cac:Country>
            </cac:PostalAddress>
            ";
        }
        // line 143
        echo "<cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[";
        // line 144
        echo $this->getAttribute(($context["client"] ?? null), "rznSocial", array());
        echo "]]></cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingCustomerParty>
    ";
        // line 148
        if ($this->getAttribute(($context["doc"] ?? null), "mtoISC", array())) {
            // line 149
            $context["iscT"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoISC", array())));
            // line 150
            echo "<cac:TaxTotal>
        <cbc:TaxAmount currencyID=\"";
            // line 151
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["iscT"] ?? null);
            echo "</cbc:TaxAmount>
        <cac:TaxSubtotal>
            <cbc:TaxAmount currencyID=\"";
            // line 153
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["iscT"] ?? null);
            echo "</cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID>2000</cbc:ID>
                    <cbc:Name>ISC</cbc:Name>
                    <cbc:TaxTypeCode>EXC</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
    </cac:TaxTotal>
    ";
        }
        // line 164
        if ($this->getAttribute(($context["doc"] ?? null), "mtoIGV", array())) {
            // line 165
            $context["igvT"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoIGV", array())));
            // line 166
            echo "<cac:TaxTotal>
        <cbc:TaxAmount currencyID=\"";
            // line 167
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["igvT"] ?? null);
            echo "</cbc:TaxAmount>
        <cac:TaxSubtotal>
            <cbc:TaxAmount currencyID=\"";
            // line 169
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["igvT"] ?? null);
            echo "</cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID>1000</cbc:ID>
                    <cbc:Name>IGV</cbc:Name>
                    <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
    </cac:TaxTotal>
    ";
        }
        // line 180
        if ($this->getAttribute(($context["doc"] ?? null), "sumOtrosCargos", array())) {
            // line 181
            $context["othT"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "sumOtrosCargos", array())));
            // line 182
            echo "<cac:TaxTotal>
        <cbc:TaxAmount currencyID=\"";
            // line 183
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["othT"] ?? null);
            echo "</cbc:TaxAmount>
        <cac:TaxSubtotal>
            <cbc:TaxAmount currencyID=\"";
            // line 185
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo ($context["othT"] ?? null);
            echo "</cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID>9999</cbc:ID>
                    <cbc:Name>OTROS</cbc:Name>
                    <cbc:TaxTypeCode>>OTH</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
    </cac:TaxTotal>
    ";
        }
        // line 196
        echo "<cac:RequestedMonetaryTotal>
        <cbc:ChargeTotalAmount currencyID=\"";
        // line 197
        echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array((($this->getAttribute(($context["doc"] ?? null), "mtoOtrosTributos", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["doc"] ?? null), "mtoOtrosTributos", array()), 0)) : (0))));
        echo "</cbc:ChargeTotalAmount>
        <cbc:PayableAmount currencyID=\"";
        // line 198
        echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["doc"] ?? null), "mtoImpVenta", array())));
        echo "</cbc:PayableAmount>
    </cac:RequestedMonetaryTotal>
    ";
        // line 200
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["doc"] ?? null), "details", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["detail"]) {
            // line 201
            echo "<cac:DebitNoteLine>
        <cbc:ID>";
            // line 202
            echo $this->getAttribute($context["loop"], "index", array());
            echo "</cbc:ID>
        <cbc:DebitedQuantity unitCode=\"";
            // line 203
            echo $this->getAttribute($context["detail"], "unidad", array());
            echo "\">";
            echo $this->getAttribute($context["detail"], "cantidad", array());
            echo "</cbc:DebitedQuantity>
        <cbc:LineExtensionAmount currencyID=\"";
            // line 204
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "mtoValorVenta", array())));
            echo "</cbc:LineExtensionAmount>
        ";
            // line 205
            if (($this->getAttribute($context["detail"], "mtoPrecioUnitario", array()) > 0)) {
                // line 206
                echo "<cac:PricingReference>
            <cac:AlternativeConditionPrice>
                <cbc:PriceAmount currencyID=\"";
                // line 208
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "mtoPrecioUnitario", array())));
                echo "</cbc:PriceAmount>
                <cbc:PriceTypeCode>01</cbc:PriceTypeCode>
            </cac:AlternativeConditionPrice>
        </cac:PricingReference>
        ";
            } else {
                // line 213
                echo "<cac:PricingReference>
            <cac:AlternativeConditionPrice>
                <cbc:PriceAmount currencyID=\"";
                // line 215
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "mtoValorGratuito", array())));
                echo "</cbc:PriceAmount>
                <cbc:PriceTypeCode>02</cbc:PriceTypeCode>
            </cac:AlternativeConditionPrice>
        </cac:PricingReference>
        ";
            }
            // line 220
            if ($this->getAttribute($context["detail"], "isc", array())) {
                // line 221
                $context["isc"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "isc", array())));
                // line 222
                echo "<cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
                // line 223
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo ($context["isc"] ?? null);
                echo "</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 225
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo ($context["isc"] ?? null);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:TierRange>";
                // line 227
                echo $this->getAttribute($context["detail"], "tipSisIsc", array());
                echo "</cbc:TierRange>
                    <cac:TaxScheme>
                        <cbc:ID>2000</cbc:ID>
                        <cbc:Name>ISC</cbc:Name>
                        <cbc:TaxTypeCode>EXC</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        ";
            }
            // line 237
            if ($this->getAttribute($context["detail"], "igv", array())) {
                // line 238
                $context["igv"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "igv", array())));
                // line 239
                echo "<cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
                // line 240
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo ($context["igv"] ?? null);
                echo "</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 242
                echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
                echo "\">";
                echo ($context["igv"] ?? null);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:TaxExemptionReasonCode>";
                // line 244
                echo $this->getAttribute($context["detail"], "tipAfeIgv", array());
                echo "</cbc:TaxExemptionReasonCode>
                    <cac:TaxScheme>
                        <cbc:ID>1000</cbc:ID>
                        <cbc:Name>IGV</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        ";
            }
            // line 254
            echo "<cac:Item>
            <cbc:Description><![CDATA[";
            // line 255
            echo $this->getAttribute($context["detail"], "descripcion", array());
            echo "]]></cbc:Description>
            <cac:SellersItemIdentification>
                <cbc:ID>";
            // line 257
            echo $this->getAttribute($context["detail"], "codProducto", array());
            echo "</cbc:ID>
            </cac:SellersItemIdentification>
            ";
            // line 259
            if ($this->getAttribute($context["detail"], "codProdSunat", array())) {
                // line 260
                echo "<cac:CommodityClassification>
                <cbc:ItemClassificationCode listID=\"UNSPSC\" listAgencyName=\"GS1 US\" listName=\"Item Classification\">";
                // line 261
                echo $this->getAttribute($context["detail"], "codProdSunat", array());
                echo "</cbc:ItemClassificationCode>
            </cac:CommodityClassification>
            ";
            }
            // line 264
            echo "</cac:Item>
        <cac:Price>
            <cbc:PriceAmount currencyID=\"";
            // line 266
            echo $this->getAttribute(($context["doc"] ?? null), "tipoMoneda", array());
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute($context["detail"], "mtoValorUnitario", array())));
            echo "</cbc:PriceAmount>
        </cac:Price>
    </cac:DebitNoteLine>
   ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 270
        echo "</DebitNote>";
    }

    public function getTemplateName()
    {
        return "notadb.xml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  633 => 270,  613 => 266,  609 => 264,  603 => 261,  600 => 260,  598 => 259,  593 => 257,  588 => 255,  585 => 254,  572 => 244,  565 => 242,  558 => 240,  555 => 239,  553 => 238,  551 => 237,  538 => 227,  531 => 225,  524 => 223,  521 => 222,  519 => 221,  517 => 220,  507 => 215,  503 => 213,  493 => 208,  489 => 206,  487 => 205,  481 => 204,  475 => 203,  471 => 202,  468 => 201,  451 => 200,  444 => 198,  438 => 197,  435 => 196,  419 => 185,  412 => 183,  409 => 182,  407 => 181,  405 => 180,  389 => 169,  382 => 167,  379 => 166,  377 => 165,  375 => 164,  359 => 153,  352 => 151,  349 => 150,  347 => 149,  345 => 148,  338 => 144,  335 => 143,  328 => 139,  323 => 137,  319 => 136,  316 => 135,  314 => 134,  312 => 133,  307 => 131,  303 => 130,  300 => 129,  298 => 128,  291 => 124,  284 => 120,  279 => 118,  275 => 117,  271 => 116,  267 => 115,  263 => 114,  260 => 113,  258 => 112,  253 => 110,  246 => 106,  233 => 96,  227 => 93,  220 => 89,  217 => 88,  215 => 87,  205 => 83,  201 => 82,  198 => 81,  194 => 80,  192 => 79,  186 => 76,  182 => 75,  175 => 71,  171 => 70,  167 => 69,  162 => 67,  158 => 66,  154 => 65,  148 => 64,  137 => 55,  128 => 52,  124 => 51,  121 => 50,  117 => 49,  109 => 46,  105 => 44,  103 => 43,  93 => 36,  89 => 35,  85 => 34,  81 => 33,  78 => 32,  76 => 31,  74 => 30,  66 => 27,  62 => 25,  60 => 24,  52 => 21,  48 => 19,  46 => 18,  38 => 15,  34 => 13,  32 => 12,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "notadb.xml.twig", "C:\\Users\\McGiver\\Projects\\api-dokel\\vendor\\greenter\\xml\\src\\Xml\\Templates\\notadb.xml.twig");
    }
}
