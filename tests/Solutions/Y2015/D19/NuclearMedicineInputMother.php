<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19;

final class NuclearMedicineInputMother
{
    public static function some(): NuclearMedicineInput
    {
        return (new NuclearMoleculeInputParser())->parse(
            <<<EOF
            Al => ThF
            Al => ThRnFAr
            B => BCa
            B => TiB
            B => TiRnFAr
            Ca => CaCa
            Ca => PB
            Ca => PRnFAr
            Ca => SiRnFYFAr
            Ca => SiRnMgAr
            Ca => SiTh
            F => CaF
            F => PMg
            F => SiAl
            H => CRnAlAr
            H => CRnFYFYFAr
            H => CRnFYMgAr
            H => CRnMgYFAr
            H => HCa
            H => NRnFYFAr
            H => NRnMgAr
            H => NTh
            H => OB
            H => ORnFAr
            Mg => BF
            Mg => TiMg
            N => CRnFAr
            N => HSi
            O => CRnFYFAr
            O => CRnMgAr
            O => HP
            O => NRnFAr
            O => OTi
            P => CaP
            P => PTi
            P => SiRnFAr
            Si => CaSi
            Th => ThCa
            Ti => BP
            Ti => TiTi
            e => HF
            e => NAl
            e => OMg
            
            CRnSiRnCaPTiMgYCaPTiRnFArSiThFArCaSiThSiThPBCaCaSiRnSiRnTiTiMgArPBCaPMgYPTiRnFArFArCaSiRnBPMgArPRnCaPTiRnFArCaSiThCaCaFArPBCaCaPTiTiRnFArCaSiRnSiAlYSiThRnFArArCaSiRnBFArCaCaSiRnSiThCaCaCaFYCaPTiBCaSiThCaSiThPMgArSiRnCaPBFYCaCaFArCaCaCaCaSiThCaSiRnPRnFArPBSiThPRnFArSiRnMgArCaFYFArCaSiRnSiAlArTiTiTiTiTiTiTiRnPMgArPTiTiTiBSiRnSiAlArTiTiRnPMgArCaFYBPBPTiRnSiRnMgArSiThCaFArCaSiThFArPRnFArCaSiRnTiBSiThSiRnSiAlYCaFArPRnFArSiThCaFArCaCaSiThCaCaCaSiRnPRnCaFArFYPMgArCaPBCaPBSiRnFYPBCaFArCaSiAl
            EOF,
        );
    }
}
