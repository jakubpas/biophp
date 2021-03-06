<?php

// authors    Joseba Bikandi, Mark Brooks
// license   GNU GPL v2
// source code available at  biophp.org


// the code in the top will retrieve data and manipulated it
// in the middle are located the functions used in this script
// in the bottom of the file is located the form


?>

<html>
<head>
<title>Reduced (redundant or simplified) alphabets for proteins</title>
</head>
<body bgcolor=FFFFFF>
<div align=right><a href=?info target=new>References</a></div>
<center><h2>Reduced (redundant or simplified) alphabets for proteins</h2></center>
<?php

if ($_SERVER["QUERY_STRING"]=="custom_alphabet"){print_custom_reduced_alphabet_info();die();}
if ($_SERVER["QUERY_STRING"]=="info"){print_info();die();}

// GET DATA
$type=$_POST["type"];
$aaperline=$_POST["aaperline"];
$seq=$_POST["seq"];
        $seq=remove_non_coding_prot($seq);

// START MAIN TABLE
print "<table align=center><tr><td><pre>\n";

// REDUCE ALPHABET
if ($_POST["mode"]=="pre"){
        // for predefined reduced alphabets
        if ($seq!="" and $type!="" and $aaperline!=""){
                $reduced_seq=reduce_alphabet($seq,$type);
                $seq=chunk_split($seq, $aaperline);
                $reduced_seq=chunk_split($reduced_seq, $aaperline);
                $colored_seq=color($seq,$reduced_seq,$type);
                print_reduced_code_info($type);
                if($_POST["show_reduced"]==1){
                        $colored_reduced_seq=color($reduced_seq,$reduced_seq,$type);
                        print "<hr><b>Reduced alphabet\n".$colored_reduced_seq."</b>";
                }
                print "<hr><b>Colored sequence\n".$colored_seq."</b><hr>";
        }
}else{
        // for personalized reduced alphabets
        if ($seq!="" and $aaperline!=""){
                $custom_alphabet=strtoupper($_POST["custom_alphabet"]);
                if (strlen($custom_alphabet)!=20){die("Error:<br>The personalized alphabet is not correct");}
                $reduced_seq=reduce_alphabet_custom($seq,$custom_alphabet);
                $reduced_seq=chunk_split($reduced_seq, $aaperline);
                $reduced_seq=chunk_split($reduced_seq, $aaperline);
                $colored_seq=color_custom($seq,$reduced_seq,$custom_alphabet);
                print "<b>Personalized alphabet</b>\nAminoacids:   ".color_custom("ARNDCEQGHILKMFPSTWYV",$custom_alphabet,$custom_alphabet)."\nReduced code: ".color_custom($custom_alphabet,$custom_alphabet,$custom_alphabet);
                if($_POST["show_reduced"]==1){
                        $colored_reduced_seq=color_custom($reduced_seq,$reduced_seq,$custom_alphabet);
                        print "<hr><b>Reduced alphabet\n".$colored_reduced_seq."</b>";
                }
                print "<hr><b>Colored sequence\n".$colored_seq."</b><hr>";
        }
}
// END REDUCE ALPHABET




// #######################################################################
// ###################         FUNCTIONS         #########################
// #######################################################################

// #######################################################################
function  print_reduced_code_info($type){
        if ($type==20){
                print "<b>Complete alphabet";
        }
        if ($type==2){
                print "<b>Two letters alphabet</b>\nAGTSNQDEHRKP => P: Hydrophilic\nCMFILVWY =>H: Hydrophobic";
        }
        if ($type==5){
                print "<b>Five letters alphabet: Chemical / structural properties</b>\nIVL   => A: Aliphatic\nFYWH  => R: Aromatic\nKRDE  => C: Charged\nGACS  => T: Tiny\nTMQNP => D: Diverse";
        }
        if ($type==6){
                print "<b>Six letters alphabet: Chemical / structural properties #2</b>\nIVL   => A: Aliphatic\nFYWH  => R: Aromatic\nKR    => C: Pos. charged\nDE    => C: Neg. charged\nGACS  => T: Tiny\nTMQNP => D: Diverse";
        }
        if ($type=="3IMG"){
                print "<b>3 IMGT amino acid hydropathy alphabet</b>\nIVLFCMAW => P: Hydrophilic\nGTSYPM => N: Neutral\nDNEQKR =>H: Hydrophobic";
        }
        if ($type=="5IMG"){
                print "<b>5 IMGT amino acid volume alphabet</b>\nGAS   => G: 60-90\nCDPNT => C: 108-117\nEVQH  => E: 138-154\nMILKR => M: 162-174\nFYW   => F: 189-228";
        }
        if ($type=="11IMG"){
                print "<b>11 IMGT amino acid chemical characteristics alphabet</b>\nAVIL => A: Aliphatic\nF    => F: Phenylalanine\nCM   => C: Sulfur\nG    => G: Glycine\nST   => S: Hydroxyl\nW    => W: Tryptophan\nY    => Y: Tyrosine\nP    => P: Proline\nDE   => A: Acidic\nNQ   => N: Amide\nHKR  => H: Basic";
        }
        if ($type=="Murphy15"){
                print "<b>Murphy et al, 2000; 15 letters alphabet</b>\nLVIM => L: Large hydrophobic\nC    => C\nA    => A\nG    => G\nS    => S\nT    => T\nP    => P\nFY   => F: Hydrophobic/aromatic sidechains\nW    => W\nE    => E\nD    => D\nN    => N\nQ    => Q\nKR   => K: Long-chain positively charged\nH    => H";
        }
        if ($type=="Murphy10"){
                print "<b>Murphy et al, 2000; 10 letters alphabet</b>\nLVIM => L: Large hydrophobic\nC    => C\nA    => A\nG    => G\nST   => S: Polar\nP    => P\nFYW  => F:Hydrophobic/aromatic sidechains\nEDNQ => E: Charged / polar\nKR   => K: Long-chain positively charged\nH    =>H";
        }
        if ($type=="Murphy8"){
                print "<b>Murphy et al, 2000; 8 letters alphabet</b>\nLVIMC => L: Hydrophobic\nAG    => A\nST    => S: Polar\nP     => P\nFYW   => F: Hydrophobic/aromatic sidechains\nEDNQ  => E\nKR    => K: Long-chain positively charged\nH     => H";
        }
        if ($type=="Murphy4"){
                print "<b>Murphy et al, 2000; 4 letters alphabet</b>\nLVIMC   => L: Hydrophobic\nAGSTP   => A\nFYW     => F: Hydrophobic/aromatic sidechains\nEDNQKRH =>E";
        }
        if ($type=="Murphy2"){
                print "<b>Murphy et al, 2000; 2 letters alphabet</b>\nLVIMCAGSTPFYW => P: Hydrophobic\nEDNQKRH       => E: Hydrophilic";
        }
        if ($type=="Wang5"){
                print "<b>Wang & Wang, 1999; 5 letters alphabet</b>\nCMFILVWY => I\nATH      => A\nGP       => G\nDE       => E\nSNQRK    => K";
        }
        if ($type=="Wang5v"){
                print "<b>Wang & Wang, 1999; 5 letters variant alphabet</b>\nCMFI => I\nLVWY => L\nATGS => A\nNQDE => E\nHPRK => K";
        }
        if ($type=="Wang3"){
                print "<b>Wang & Wang, 1999; 3 letters alphabet</b>\nCMFILVWY => I\nATHGPR   => A\nDESNQK   => E";
        }
        if ($type=="Wang2"){
                print "<b>Wang & Wang, 1999; 2 letters alphabet</b>\nCMFILVWY     => I\nATHGPRDESNQK => A";
        }
        if ($type=="Li10"){
                print "<b>Li et al, 2003; 10 letters alphabet</b>\nC   => C\nFYW => Y\nML  => L\nIV  => V\nG   => G\nP   => P\nATS => S\nNH  => N\nQED => E\nRK  => K";
        }
        if ($type=="Li5"){                                       // YIGSE
                print "<b>Li et al, 2003; 5 letters alphabet</b>\nCFYW    => Y\nMLIV    => I\nG       => G\nPATS    => S\nNHQEDRK => E";
        }
        if ($type=="Li4"){                                        // YISE
                print "<b>Li et al, 2003; 4 letters alphabet</b>\nCFYW    => Y\nMLIV    => I\nGPATS   => S\nNHQEDRK => E";
        }
        if ($type=="Li3"){                                       // ISE
                print "<b>Li et al, 2003; 3 letters alphabet</b>\nCFYWMLIV => I\nGPATS    => S\nNHQEDRK  => E";
        }
}
// #######################################################################
// Get colored html code for $seq by using the $seq2 (the reduced sequence)
// as a reference, and according to the $type of reduction selected
// returns an html code
function color($seq,$seq2,$type){
        $letters_array["20"]=array(
                                        "A"=>"CCFFFF",
                                        "R"=>"E60606",
                                        "N"=>"FF9900",
                                        "D"=>"FFCC99",
                                        "C"=>"00FFFF",
                                        "E"=>"FFCC00",
                                        "Q"=>"FF6600",
                                        "G"=>"00FF00",
                                        "H"=>"FFFF99",
                                        "I"=>"000088",
                                        "L"=>"3366FF",
                                        "K"=>"C64200",
                                        "M"=>"99CCFF",
                                        "F"=>"00CCFF",
                                        "P"=>"FFFF00",
                                        "S"=>"CCFF99",
                                        "T"=>"00FF99",
                                        "W"=>"CC99FF",
                                        "Y"=>"CCFFCC",
                                        "V"=>"0000FF"
                                  );

        $letters_array["2"]=array(       "P"=>"0000FF",
                                         "H"=>"FF0000"
                                  );
        $letters_array["5"]=array(       "A"=>"FF0000",
                                         "R"=>"00FF00",
                                         "C"=>"0000FF",
                                         "T"=>"FFFF00",
                                         "D"=>"00FFFF"
                                  );
        $letters_array["6"]=array(       "A"=>"FF0000",
                                         "R"=>"00FF00",
                                         "P"=>"0000FF",
                                         "N"=>"8888FF",
                                         "T"=>"FFFF00",
                                         "D"=>"00FFFF"
                                  );

        $letters_array["3IMG"]=array(   "P"=>"E60606",
                                        "N"=>"FFFF00",
                                        "H"=>"3366FF"
                                  );
        $letters_array["5IMG"]=array(   "G"=>"E60606",
                                        "C"=>"E60606",
                                        "E"=>"E60606",
                                        "M"=>"E60606",
                                        "F"=>"E60606",
                                  );
        $letters_array["11IMG"]=array(  "A"=>"1B04AE",
                                        "F"=>"00CCFF",
                                        "C"=>"CCECFF",
                                        "G"=>"00FF00",
                                        "S"=>"89F88B",
                                        "W"=>"CC99FF",
                                        "Y"=>"CCFFCC",
                                        "P"=>"FFFF00",
                                        "D"=>"FFCC00",
                                        "N"=>"F4A504",
                                        "H"=>"EC1504",
                                  );

        $letters_array["Murphy15"]=array("L"=>"FF0000",
                                         "C"=>"00FF00",
                                         "A"=>"0000FF",
                                         "G"=>"FFFF00",
                                         "S"=>"00FFFF",
                                         "T"=>"FF00FF",
                                         "P"=>"880000",
                                         "F"=>"008800",
                                         "W"=>"000088",
                                         "E"=>"888800",
                                         "D"=>"008888",
                                         "N"=>"880088",
                                         "Q"=>"FF8888",
                                         "K"=>"88FF88",
                                         "H"=>"8888FF"
                                         );
        $letters_array["Murphy10"]=array("L"=>"FF0000",
                                         "C"=>"00FF00",
                                         "A"=>"0000FF",
                                         "G"=>"FFFF00",
                                         "S"=>"00FFFF",
                                         "P"=>"880000",
                                         "F"=>"008800",
                                         "E"=>"888800",
                                         "K"=>"88FF88",
                                         "H"=>"8888FF"
                                         );
        $letters_array["Murphy8"]=array( "L"=>"FF0000",
                                         "A"=>"0000FF",
                                         "S"=>"00FFFF",
                                         "P"=>"880000",
                                         "F"=>"0000FF",
                                         "E"=>"008800",
                                         "K"=>"88FF88",
                                         "H"=>"0000FF"
                                         );
        $letters_array["Murphy4"]=array( "L"=>"00FF00",
                                         "A"=>"00FFFF",
                                         "F"=>"FF0000",
                                         "E"=>"0000FF"
                                         );
        $letters_array["Murphy2"]=array( "P"=>"FF0000",
                                         "E"=>"0000FF"
                                         );
        $letters_array["Wang5"]=array(   "I"=>"FF0000",
                                         "A"=>"00FF00",
                                         "G"=>"FFFF00",
                                         "E"=>"0000FF",
                                         "K"=>"00FFFF"
                                         );
        $letters_array["Wang5v"]=array(  "I"=>"FF0000",
                                         "L"=>"FFFF00",
                                         "A"=>"00FF00",
                                         "E"=>"0000FF",
                                         "K"=>"00FFFF"
                                         );
        $letters_array["Wang3"]=array(   "I"=>"FF0000",
                                         "A"=>"00FF00",
                                         "E"=>"0000FF"
                                         );
        $letters_array["Wang2"]=array(   "I"=>"FF0000",
                                         "A"=>"0000FF"
                                         );
        $letters_array["Li10"]=array(    "C"=>"FF0000",
                                         "Y"=>"FFFF00",
                                         "L"=>"FF00FF",
                                         "V"=>"FF8888",
                                         "G"=>"00FFFF",
                                         "P"=>"88FF88",
                                         "S"=>"00FF00",
                                         "N"=>"8888FF",
                                         "E"=>"0000FF",
                                         "K"=>"88FFFF"
                                         );
        $letters_array["Li5"]=array(     "Y"=>"FFFF00",
                                         "I"=>"FF0000",
                                         "G"=>"00FFFF",
                                         "S"=>"00FF00",
                                         "E"=>"0000FF"
                                         );
        $letters_array["Li4"]=array(     "Y"=>"FFFF00",
                                         "I"=>"FF0000",
                                         "S"=>"00FF00",
                                         "E"=>"0000FF"
                                         );
        $letters_array["Li3"]=array(     "I"=>"FF0000",
                                         "S"=>"00FF00",
                                         "E"=>"0000FF"
                                         );

        
        $new_seq="";
        for($i=0;$i<strlen($seq);$i++){
                $letter_seq=substr($seq,$i,1);
                $letter_seq2=substr($seq2,$i,1);
                if ($letters_array[$type][$letter_seq2]!=""){
                        $new_seq.="<font color=".strtolower($letters_array[$type][$letter_seq2]).">$letter_seq</font>";
                }else{
                        $new_seq.=$letter_seq;
                }
        }

        return $new_seq;
}


// #######################################################################
// Reduce alphabet for $seq by using the predefined $type type of reduction
//  returns a reduced sequence
function reduce_alphabet($seq,$type){
        if ($type==20){
                // Not reduced, so nothing to do
        }
        if ($type==2){                                                     // PH
                $seq=preg_replace("/A|G|T|S|N|Q|D|E|H|R|K|P/","p",$seq);   // Hydrophilic
                $seq=preg_replace("/C|M|F|I|L|V|W|Y/","h",$seq);           // Hydrophobic
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type==5){                                        // ARCTD
                $seq=preg_replace("/I|V|L/","a",$seq);        // Aliphatic
                $seq=preg_replace("/F|Y|W|H/","r",$seq);      // Aromatic
                $seq=preg_replace("/K|R|D|E/","c",$seq);      // Charged
                $seq=preg_replace("/G|A|C|S/","t",$seq);      // Tiny
                $seq=preg_replace("/T|M|Q|N|P/","d",$seq);    // Diverse
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type==6){                                        // ARPNTD
                $seq=preg_replace("/I|V|L/","a",$seq);        // Aliphatic
                $seq=preg_replace("/F|Y|W|H/","r",$seq);      // Aromatic
                $seq=preg_replace("/K|R/","p",$seq);          // Pos. charged
                $seq=preg_replace("/D|E/","n",$seq);          // Neg. charged
                $seq=preg_replace("/G|A|C|S/","t",$seq);      // Tiny
                $seq=preg_replace("/T|M|Q|N|P/","d",$seq);    // Diverse
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="3IMG"){                                     // PNH
                $seq=preg_replace("/D|N|E|Q|K|R/","p",$seq);      // Hydrophilic
                $seq=preg_replace("/G|T|S|Y|P|M/","n",$seq);      // Neutral
                $seq=preg_replace("/I|V|L|F|C|M|A|W/","h",$seq);  // Hydrophobic
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="5IMG"){                                    // GCEMF  (IMGT amino acid volume)
                $seq=preg_replace("/G|A|S/","g",$seq);         // 60-90
                $seq=preg_replace("/C|D|P|N|T/","c",$seq);     // 108-117
                $seq=preg_replace("/E|V|Q|H/","e",$seq);       // 138-154
                $seq=preg_replace("/M|I|L|K|R/","m",$seq);     // 162-174
                $seq=preg_replace("/F|Y|W/","f",$seq);         // 189-228
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="11IMG"){                                // AFCGSWYPDNH
                $seq=preg_replace("/A|V|I|L/","a",$seq);       // Aliphatic
                $seq=preg_replace("/F/","f",$seq);          // Phenylalanine
                $seq=preg_replace("/C|M/","c",$seq);         // Sulfur
                $seq=preg_replace("/G/","g",$seq);          // Glycine
                $seq=preg_replace("/S|T/","s",$seq);         // Hydroxyl
                $seq=preg_replace("/W/","w",$seq);          // Tryptophan
                $seq=preg_replace("/Y/","y",$seq);          // Tyrosine
                $seq=preg_replace("/P/","p",$seq);          // Proline
                $seq=preg_replace("/D|E/","d",$seq);         // Acidic
                $seq=preg_replace("/N|Q/","n",$seq);         // Amide
                $seq=preg_replace("/H|K|R/","h",$seq);        // Basic
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="Murphy15"){                             // LCAGSTPFWEDNQKH
                $seq=preg_replace("/L|V|I|M/","l",$seq);    // Large hydrophobic
                $seq=preg_replace("/C/","c",$seq);
                $seq=preg_replace("/A/","a",$seq);
                $seq=preg_replace("/G/","g",$seq);
                $seq=preg_replace("/S/","s",$seq);
                $seq=preg_replace("/T/","t",$seq);
                $seq=preg_replace("/P/","p",$seq);
                $seq=preg_replace("/F|Y/","f",$seq);       // Hydrophobic/aromatic sidechains
                $seq=preg_replace("/W/","w",$seq);
                $seq=preg_replace("/E/","e",$seq);
                $seq=preg_replace("/D/","d",$seq);
                $seq=preg_replace("/N/","n",$seq);
                $seq=preg_replace("/Q/","q",$seq);
                $seq=preg_replace("/K|R/","k",$seq);       // Long-chain positively charged
                $seq=preg_replace("/H/","h",$seq);
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="Murphy10"){                            // LCAGSPFEKH
                $seq=preg_replace("/L|V|I|M/","l",$seq);   // Large hydrophobic
                $seq=preg_replace("/C/","c",$seq);
                $seq=preg_replace("/A/","a",$seq);
                $seq=preg_replace("/G/","g",$seq);
                $seq=preg_replace("/S|T/","s",$seq);       // Polar
                $seq=preg_replace("/P/","p",$seq);
                $seq=preg_replace("/F|Y|W/","f",$seq);     // Hydrophobic/aromatic sidechains
                $seq=preg_replace("/E|D|N|Q/","e",$seq);   // Charged / polar
                $seq=preg_replace("/K|R/","k",$seq);       // Long-chain positively charged
                $seq=preg_replace("/H/","h",$seq);
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="Murphy8"){                              // LASPFEKH
                $seq=preg_replace("/L|V|I|M|C/","l",$seq);  // Hydrophobic
                $seq=preg_replace("/A|G/","a",$seq);
                $seq=preg_replace("/S|T/","s",$seq);        // Polar
                $seq=preg_replace("/P/","p",$seq);
                $seq=preg_replace("/F|Y|W/","f",$seq);      // Hydrophobic/aromatic sidechains
                $seq=preg_replace("/E|D|N|Q/","e",$seq);
                $seq=preg_replace("/K|R/","k",$seq);        // Long-chain positively charged
                $seq=preg_replace("/H/","h",$seq);
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="Murphy4"){                                // LAFE
                $seq=preg_replace("/L|V|I|M|C/","l",$seq);    // Hydrophobic
                $seq=preg_replace("/A|G|S|T|P/","a",$seq);
                $seq=preg_replace("/F|Y|W/","f",$seq);        // Hydrophobic/aromatic sidechains
                $seq=preg_replace("/E|D|N|Q|K|R|H/","e",$seq);
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="Murphy2"){                                              //PE
                $seq=preg_replace("/L|V|I|M|C|A|G|S|T|P|F|Y|W/","p",$seq);  //Hydrophobic
                $seq=preg_replace("/E|D|N|Q|K|R|H/","e",$seq);              //Hydrophilic
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="Wang5"){                                   // IAGEK
                $seq=preg_replace("/C|M|F|I|L|V|W|Y/","i",$seq);
                $seq=preg_replace("/A|T|H/","a",$seq);
                $seq=preg_replace("/G|P/","g",$seq);
                $seq=preg_replace("/D|E/","e",$seq);
                $seq=preg_replace("/S|N|Q|R|K/","k",$seq);
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="Wang5v"){                                   // ILAEK
                $seq=preg_replace("/C|M|F|I/","i",$seq);
                $seq=preg_replace("/L|V|W|Y/","l",$seq);
                $seq=preg_replace("/A|T|G|S/","a",$seq);
                $seq=preg_replace("/N|Q|D|E/","e",$seq);
                $seq=preg_replace("/H|P|R|K/","k",$seq);
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="Wang3"){                                     // IAE
                $seq=preg_replace("/C|M|F|I|L|V|W|Y/","i",$seq);
                $seq=preg_replace("/A|T|H|G|P|R/","a",$seq);
                $seq=preg_replace("/D|E|S|N|Q|K/","e",$seq);
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="Wang2"){                                     // IA
                $seq=preg_replace("/C|M|F|I|L|V|W|Y/","i",$seq);
                $seq=preg_replace("/A|T|H|G|P|R|D|E|S|N|Q|K/","a",$seq);
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="Li10"){                                      // CYLVGPSNEK
                $seq=preg_replace("/C/","c",$seq);
                $seq=preg_replace("/F|Y|W/","y",$seq);
                $seq=preg_replace("/M|L/","l",$seq);
                $seq=preg_replace("/I|V/","v",$seq);
                $seq=preg_replace("/G/","g",$seq);
                $seq=preg_replace("/P/","p",$seq);
                $seq=preg_replace("/A|T|S/","s",$seq);
                $seq=preg_replace("/N|H/","n",$seq);
                $seq=preg_replace("/Q|E|D/","e",$seq);
                $seq=preg_replace("/R|K/","k",$seq);
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="Li5"){                                       // YIGSE
                $seq=preg_replace("/C|F|Y|W/","y",$seq);
                $seq=preg_replace("/M|L|I|V/","i",$seq);
                $seq=preg_replace("/G/","g",$seq);
                $seq=preg_replace("/P|A|T|S/","s",$seq);
                $seq=preg_replace("/N|H|Q|E|D|R|K/","e",$seq);
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="Li4"){                                        // YISE
                $seq=preg_replace("/C|F|Y|W/","y",$seq);
                $seq=preg_replace("/M|L|I|V/","i",$seq);
                $seq=preg_replace("/G|P|A|T|S/","s",$seq);
                $seq=preg_replace("/N|H|Q|E|D|R|K/","e",$seq);
                $seq=strtoupper($seq);
                return $seq;
        }
        if ($type=="Li3"){                                       // ISE
                $seq=preg_replace("/C|F|Y|W|M|L|I|V/","i",$seq);
                $seq=preg_replace("/G|P|A|T|S/","s",$seq);
                $seq=preg_replace("/N|H|Q|E|D|R|K/","e",$seq);
                $seq=strtoupper($seq);
                return $seq;
        }
    return '';
}

// #######################################################################
// removes non coding characters from $seq
// returns the filtered sequence
function remove_non_coding_prot($seq) {
        // change the sequence to upper case
        $seq=strtoupper($seq);
        // remove non-coding characters([^ARNDCEQGHILKMFPSTWYVX\*])
        $seq = preg_replace ("([^ARNDCEQGHILKMFPSTWYVX\*])", "", $seq);
        return $seq;
}

// #######################################################################
// Reduce the alphabet for $seq by using the user defined persoalized alphabet
//  returns the reduced sequence
function reduce_alphabet_custom($seq,$custom_alphabet){

        $custom_alphabet=strtolower($custom_alphabet);
        // array with reduced code
        $a=preg_split("//",$custom_alphabet,-1,PREG_SPLIT_NO_EMPTY);
        // array with aminoacids
        $b=preg_split("//","ARNDCEQGHILKMFPSTWYV",-1,PREG_SPLIT_NO_EMPTY);

        foreach($a as $key=> $val){
                // replace aminoacids by reduced codes
                $seq=preg_replace("/".$b[$key]."/",$val,$seq);
        }
        $seq=strtoupper($seq);
        return $seq;

}

// #######################################################################
// Get colored html code for $seq by using the $seq2 (the reduced sequence)
// as a reference, and according to the personalized alphabet included in the form
// returns an html code
function color_custom($seq,$seq2,$custom_alphabet){
        // get array with letters
        $a=preg_split("//",$custom_alphabet,-1,PREG_SPLIT_NO_EMPTY);
        $a=array_unique($a);
        //print_r($a);

        // define generic color
        //   the assigment order is the one shown in the list
        //   When few colors are needed, the first ones in the list are used
        $generic_colors=array(
                            0=>"FF0000",
                            1=>"00FF00",
                            2=>"0000FF",
                            3=>"FFFF00",
                            4=>"FF00FF",
                            5=>"00FFFF",
                            6=>"FF8888",
                            7=>"88FF88",
                            8=>"8888FF",
                            9=>"FFFF88",
                            10=>"FF88FF",
                            11=>"88FFFF",
                            12=>"FF3366",
                            13=>"33FF66",
                            14=>"3366FF",
                            15=>"FF6633",
                            16=>"66FF33",
                            17=>"6633FF",
                            18=>"880000",
                            19=>"008800"
                            // black is not used

        );

        // asign colors to the array
        $letters = array();
        foreach($a as $key=> $val){
                // assigment of color
                $letters[$val]=$generic_colors[$key];
        }

        $new_seq="";
        for($i=0;$i<strlen($seq);$i++){
                $letter_seq=substr($seq,$i,1);
                $letter_seq2=substr($seq2,$i,1);
                if ($letters[$letter_seq2]!=""){
                        $new_seq.="<font color=".strtolower($letters[$letter_seq2]).">$letter_seq</font>";
                }else{
                        $new_seq.=$letter_seq;
                }
        }

        return $new_seq;
}


// #######################################################################
// To print info
function  print_custom_reduced_alphabet_info(){
    ?>
    <h3>How to define a custom reduced alphabet</h3>
    <b>The procedure is very simple</b>:
    <ul>
    <li>one letter must be used for each group of aminoacids
    <br>p.e.: letters A,R,C,T and D for 5 groups</li>
    <li>aminoacid in the serie "ARNDCEQGHILKMFPSTWYV" will be substitute by letters defining the group.
    <br> p.e: from ARNDCEQGHILKMFPSTWYV to TCDCTCDTRAACDRDTDRRA </li>
    <li>the resulting serie of letters will be used in the form.</li>
    </ul>
    Colors will be automatically assigned to each letter of the alphabet (this behavior can not be personalized at the moment)
    <?
}
// #######################################################################
// To print general info
function  print_info(){
    ?>
    This tool was originally created to reduce protein sequences by grouping the aminoacids in classes.
    During its development code to retrieve sequences with colours was added. Additionally, each aminoacid
    may be displayed with a distinct colour (without applying reductions).
    <p>
    The reduced aminoacid alphabets has been obtained from the references bellow:
    Li T, Fan K, Wang J, Wang W. Reduction of protein sequence
    complexity by residue grouping. Protein Eng 2003; 5:323-330.
    <a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Retrieve&db=PubMed&list_uids=12826723&dopt=Abstract">PubMed</a>
    Murphy LR, Wallqvist A, Levy RM. Simplified amino acid alphabets
    for protein fold recognition and implications for folding.
    Protein Eng 2000; 13:149-152.
    <a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Retrieve&db=PubMed&list_uids=10775656&dopt=Abstract">PubMed</a>
    Pommi&eacute; C, Levadoux S, Sabatier R, Lefranc G & Lefranc MP.
    IMGT standardized criteria for statistical analysis of immunoglobulin
    V-REGION amino acid properties. Journal of Molecular Recognition 2004; 17:17-32.
    <a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Retrieve&db=PubMed&list_uids=14872534&dopt=Abstract">PubMed</a>
    Spitzer M, Fuellen G, Cullen P, Lorkowski S.
    VisCoSe: visualization and comparison of consensus sequences.
    Bioinformatics 2004; 20:433-435.
    <a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Retrieve&db=PubMed&list_uids=14960475&dopt=Abstract">PubMed</a>,
    <a href=http://viscose.ifg.uni-muenster.de/html/alphabets.html>Web</a>
    Wang J, Wang W. A computational approach to simplifying the protein
    folding alphabet. Nat Struct Biol 1999; 11:1033-1038. <a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Retrieve&db=PubMed&list_uids=10542095&dopt=Abstract">PubMed</a>
    <p>The script has been created entirely with PHP scripting language, and source code is available at
    <a href=http://www.biophp.org/minitools/reduce_protein_alphabet>BioPHP.org</a></p>
<?
}
// #######################################################################
// ########################   END FUNCTIONS   ############################
// #######################################################################


// define defaulds (in case nothing is posted)
if($seq==""){$seq="ARNDCEQGHILKMFPSTWYVX*";}
if($aaperline==""){$aaperline=100;}


// #######################################################################
// ########################    PRINT FORM     ############################
// #######################################################################
?>
<tr><td>

<form method=post name=<? print $_SERVER["PHP_SELF"]; ?>>
        <b>Sequence:</b>
        <br>
        <textarea name=seq cols=75 rows=10><?= $seq; ?></textarea>

        <br>
        <input type=radio name=mode value=pre<? if ($_POST["mode"]!="custom"){print " checked";} ?>> Select Reduced alphabet
        <br>&nbsp;&nbsp;&nbsp;<select name="type">
        <option value="">Select Reduced alphabet
        <option value=2<? if ($type=="20"){print " selected";} ?>>Do not reduced
        <option value=2<? if ($type=="2"){print " selected";} ?>>Hydrophilic/Hydrophobic
        <option value=5<? if ($type=="5"){print " selected";} ?>>Chemical / structural properties
        <option value=6<? if ($type=="6"){print " selected";} ?>>Chemical / structural properties #2
        <option value=3IMG<? if ($type=="3IMG"){print " selected";} ?>>3 IMGT amino acid hydropathy alphabet
        <option value=5IMG<? if ($type=="5IMG"){print " selected";} ?>>5 IMGT amino acid volume alphabet
        <option value=11IMG<? if ($type=="11IMG"){print " selected";} ?>>11 IMGT amino acid chemical characteristics alphabet
        <option value=Murphy15<? if ($type=="Murphy15"){print " selected";} ?>>Murphy et al, 15
        <option value=Murphy10<? if ($type=="Murphy10"){print " selected";} ?>>Murphy et al, 10
        <option value=Murphy8<? if ($type=="Murphy8"){print " selected";} ?>>Murphy et al, 8
        <option value=Murphy4<? if ($type=="Murphy4"){print " selected";} ?>>Murphy et al, 4
        <option value=Murphy2<? if ($type=="Murphy2"){print " selected";} ?>>Murphy et al, 2
        <option value=Wang5<? if ($type=="Wang5"){print " selected";} ?>>Wang & Wang, 5
        <option value=Wang5v<? if ($type=="Wang5v"){print " selected";} ?>>Wang & Wang, 5 variant
        <option value=Wang3<? if ($type=="Wang3"){print " selected";} ?>>Wang & Wang, 3
        <option value=Wang2<? if ($type=="Wang2"){print " selected";} ?>>Wang & Wang, 2
        <option value=Li10<? if ($type=="Li10"){print " selected";} ?>>Li et al, 10
        <option value=Li5<? if ($type=="Li5"){print " selected";} ?>>Li et al, 5
        <option value=Li4<? if ($type=="Li4"){print " selected";} ?>>Li et al, 4
        <option value=Li3<? if ($type=="Li3"){print " selected";} ?>>Li et al, 3
        </select>

        <br><input type=radio name=mode value=custom<? if ($_POST["mode"]=="custom"){print " checked";} ?>> Use Personalized alphabet
        <br>&nbsp;&nbsp;&nbsp;<input type=text name=custom_alphabet value=TCDCTCDTRAACDRDTDRRA size=30> <a href=?custom_alphabet target=new>info</a>
        <p>&nbsp; <input type=submit value=submit>

        <hr>
        Aminoacids per line: <input name=aaperline type=text value=<?= $aaperline; ?>>
        <br><input type=checkbox name=show_reduced value=1<? if($_POST["show_reduced"]==1){print " checked";} ?>> Show reduced alphabet
</form>

<hr>
</td></tr></table>
<center>Source code is available at <a href=http://www.biophp.org/minitools/reduce_protein_alphabet>BioPHP.org</a></center>

<?
// #######################################################################
// ######################   END PRINT FORM     ###########################
// #######################################################################

?>


</body>
</html>