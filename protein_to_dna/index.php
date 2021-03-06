<html><head><title>Protein to DNA reverse translation</title>
</head><body bgcolor=white text=black>
<?php
// author    Joseba Bikandi
// license   GNU GPL v2
error_reporting(0);

//If nothing is posted, print form and die
if (!$_POST){print_form();die();}  // from is in the bottom

// IF INFO IS POSTED, GO AHEAD
        // Get the sequence
        $sequence = strtoupper($_POST["sequence"]);

        // remove non-coding chacacters
        $sequence = preg_replace ("([^FLIMVSPTAY*HQNKDECWRGX\*])", "", $sequence);
        $len=strlen($sequence);

        // Get the genetic code to be used for translation
        $genetic_code = $_POST["genetic_code"];

        // Translate in  5-3 direction
        $dna=translate_protein_to_DNA($sequence, 1);

        $sequence=chunk_split($sequence,20);
        print "<pre><font size=+1>Input sequence\n\n$sequence<hr>";

        // In next lines, the DNA code will be colored and output
                $dna=chunk_split($dna,60,'<br>');

                // just to put a bit of color
                $color="red";  // or blue, green, white, black, magenta...
                $dna=preg_replace("/A/","<font color=".$color.">A</font>",$dna);
                $dna=preg_replace("/C/","<font color=".$color.">C</font>",$dna);
                $dna=preg_replace("/G/","<font color=".$color.">G</font>",$dna);
                $dna=preg_replace("/T/","<font color=".$color.">T</font>",$dna);

                // two lines to reduce the code to be transmitted
                $dna=preg_replace("/<\/font><font color=$color>/","",$dna);
                $dna=preg_replace("/<\/font> <font color=$color>/"," ",$dna);

                // print DNA code
                print "Reverse Translated sequence\n\n$dna</font>";


// ########################## FUNTIONS ############################################
function translate_protein_to_DNA($seq,$genetic_code){

        // $aminoacids is the array of aminoacids
        $aminoacids=array("(F )","(L )","(I )","(M )","(V )","(S )","(P )","(T )","(A )","(Y )",
                          "(\* )","(H )","(Q )","(N )","(K )","(D )","(E )","(C )","(W )","(R )",
                          "(G )","(X )");

        // $triplets is the array containning the genetic codes
        // Info has been extracted from http://www.ncbi.nlm.nih.gov/Taxonomy/Utils/wprintgc.cgi?mode

        // Standard genetic code
        $triplets[1]=array("TTY","YTN","ATH","ATG","GTN","WSN","CCN","ACN","GCN","TAY",
                           "TRR","CAY","CAR","AAY","AAR","GAY","GAR","TGY","TGG","MGN",
                           "GGN","NNN");
        // Vertebrate Mitochondrial
        $triplets[2]=array("TTY","YTN","ATY","ATR","GTN","WSN","CCN","ACN","GCN","TAY",
                           "WRR","CAY","CAR","AAY","AAR","GAY","GAR","TGY","TGR","CGN",
                           "GGN","NNN");
        // Yeast Mitochondrial
        $triplets[3]=array("TTY","TTR","ATY","ATR","GTN","WSN","CCN","MYN","GCN","TAY",
                           "TAR","CAY","CAR","AAY","AAR","GAY","GAR","TGY","TGR","MGN",
                           "GGN","NNN");
        // Mold, Protozoan and Coelenterate Mitochondrial. Mycoplasma, Spiroplasma
        $triplets[4]=array("TTY","YTN","ATH","ATG","GTN","WSN","CCN","ACN","GCN","TAY",
                           "TAR","CAY","CAR","AAY","AAR","GAY","GAR","TGY","TGR","MGN",
                           "GGN","NNN");
        // Invertebrate Mitochondrial
        $triplets[5]=array("TTY","YTN","ATY","ATR","GTN","WSN","CCN","WSN","GCN","TAY",
                           "TAR","CAY","CAR","AAY","AAR","GAY","GAR","TGY","TGR","CGN",
                           "GGN","NNN");
        // Ciliate Nuclear; Dasycladacean Nuclear; Hexamita Nuclear
        $triplets[6]=array("TTY","YTN","ATH","ATG","GTN","WSN","CCN","ACN","GCN","TAY",
                           "TGA","CAY","YAR","AAY","AAR","GAY","GAR","TGY","TGG","MGN",
                           "GGN","NNN");
        // Echinoderm Mitochondrial
        $triplets[9]=array("TTY","YTN","ATH","ATG","GTN","WSN","CCN","WCN","GCN","TAY",
                           "TAR","CAY","CAR","AAH","AAG","GAY","GAR","TGY","TGR","CGN",
                           "GGN","NNN");
        // Euplotid Nuclear
        $triplets[10]=array("TTY","YTN","ATH","ATG","GTN","WSN","CCN","ACN","GCN","TAY",
                           "TAR","CAY","CAR","AAY","AAR","GAY","GAR","TGH","TGG","MGN",
                           "GGN","NNN");
        // Bacterial and Plant Plastid
        $triplets[11]=array("TTY","YTN","ATH","ATG","GTN","WSN","CCN","ACN","GCN","TAY",
                           "TRR","CAY","CAR","AAY","AAR","GAY","GAR","TGY","TGG","MGN",
                           "GGN","NNN");
        // Alternative Yeast Nuclear
        $triplets[12]=array("TTY","YTN","ATH","ATG","GTN","HBN","CCN","ACN","GCN","TAY",
                           "TRR","CAY","CAR","AAY","AAR","GAY","GAR","TGY","TGG","MGN",
                           "GGN","NNN");
        // Ascidian Mitochondrial
        $triplets[13]=array("TTY","YTN","ATY","ATR","GTN","WSN","CCN","ACN","GCN","TAY",
                           "TAR","CAY","CAR","AAY","AAR","GAY","GAR","TGY","TGR","CGN",
                           "RGN","NNN");
        // Flatworm Mitochondrial
        $triplets[14]=array("TTY","YTN","ATH","ATG","GTN","WSN","CCN","ACN","GCN","TAH",
                           "TAG","CAY","CAR","ATH","AAG","GAY","GAR","TGY","TGR","CGN",
                           "GGN","NNN");
        // Blepharisma Macronuclear
        $triplets[15]=array("TTY","YTN","ATH","ATG","GTN","WSN","CCN","ACN","GCN","TAY",
                           "TRA","CAY","YAR","AAY","AAR","GAY","GAR","TGY","TGG","MGN",
                           "GGN","NNN");
        // Chlorophycean Mitochondrial
        $triplets[16]=array("TTY","YWN","ATH","ATG","GTN","WSN","CCN","ACN","GCN","TAY",
                           "TRA","CAY","CAR","AAY","AAR","GAY","GAR","TGY","TGG","MGN",
                           "GGN","NNN");
        // Trematode Mitochondrial
        $triplets[21]=array("TTY","YTN","ATY","ATR","GTN","WSN","CCN","ACN","GCN","TAY",
                           "TAR","CAY","CAR","AAH","AAG","GAY","GAR","TGY","TGR","CGN",
                           "GGN","NNN");
        // Scenedesmus obliquus mitochondrial
        $triplets[22]=array("TTY","YWN","ATH","ATG","GTN","WSB","CCN","ACN","GCN","TAY",
                           "TVR","CAY","CAR","AAY","AAR","GAY","GAR","TGY","TGG","MGN",
                           "GGN","NNN");
        // Thraustochytrium mitochondrial code
        $triplets[23]=array("TTY","YTN","ATH","ATG","GTN","WSN","CCN","ACN","GCN","TAY",
                           "TDR","CAY","CAR","AAY","AAR","GAY","GAR","TGY","TGG","MGN",
                           "GGN","NNN");

        // place a space after each aminoacid in the sequence
        $temp = chunk_split($seq,1,' ');

        // replace aminoacid by corresponding amnoacid
        $peptide = preg_replace ($aminoacids, $triplets[$genetic_code], $temp);

        // return peptide sequence
        return $peptide;

}

function print_form(){
?>
<center>
<form name=mydna method=post action="<? print $_SERVER["PHP_SELF"]; ?>">
<h2>Protein to DNA reverse translation</h2>
Protein sequence<br>
<textarea name=sequence cols=75 rows=10>
FLIMVSPTAYHQNKDECWRGX*
</textarea>
<br>
        Genetic code: <select name=genetic_code>
                <option value=1 selected>Standard
                <option value=2>Vertebrate Mitochondrial
                <option value=3>Yeast Mitochondrial
                <option value=4>Mold, Protozoan and Coelenterate Mitochondrial. Mycoplasma, Spiroplasma
                <option value=5>Invertebrate Mitochondrial
                <option value=6>Ciliate Nuclear; Dasycladacean Nuclear; Hexamita Nuclear
                <option value=9>Echinoderm Mitochondrial
                <option value=10>Euplotid Nuclear
                <option value=11>Bacterial and Plant Plastid
                <option value=12>Alternative Yeast Nuclear
                <option value=13>Ascidian Mitochondrial
                <option value=14>Flatworm Mitochondrial
                <option value=15>Blepharisma Macronuclear
                <option value=16>Chlorophycean Mitochondrial
                <option value=21>Trematode Mitochondrial
                <option value=22>Scenedesmus obliquus mitochondrial
                <option value=23>Thraustochytrium mitochondrial code
                </select>
<P>
<input type=submit value="&nbsp; Translate to DNA &nbsp;">

<hr width=500>
Source code available at <a href=http://www.biophp.org/minitools/protein_to_dna>biophp.org</a>
<p>
<div align=right><a href="../dna_to_protein/index.php">DNA to Protein</a></div>

<? } ?>
<hr>
Source code available at <a href=http://www.biophp.org/minitools/protein_to_dna>biophp.org</a>
</body></html>
