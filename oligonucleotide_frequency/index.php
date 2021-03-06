<html>
<head><title>Oligonucleotide frequencies</title>
</head>
<body bgcolor=FFFFFF>
<center>
<h2>Frequency of nucleotides and oligonucleotides in a sequence</h2>
This demo is limited to oligos 1-3 bases long, and a maximum input sequence of 10000 bp.
<pZ>
<?php
exec("renice +10 ".getmypid()); // reduce priority for this script in linux
error_reporting(0);             // to avoid errors

// The method used bellow may not be very efficient, but probably it is easy to understand
// so it may be easy to customized for other porposes
// For suggestion or problems, http://www.in-silico.com/contact.php
// Let us know the name of the script


if (!$_POST){
        print_form ();
}else{
        // get data from form
        $sequence=strtoupper($_POST["sequence"]);
        $oligo_len=$_POST["len"];
        $strands=$_POST["strands"];

        // remove useless from sequence (non-letters and digists are removed)
        $sequence=preg_replace("/\W|\d/","",$sequence);  // removed

        // when length of query sequence is 0 => error
        if (strlen($sequence)==0){die("Error: query sequence not provided. Plase go back andtry again.");}
        if (strlen($sequence)>1000000){die("Error: sequence is too long. Download the script from biophp.org and used it localy.");}

        // when length of query sequence is bellow 4^oligo_len => error (to avoid a lot of 0 frequencies);
       if (strlen($sequence)<pow(4,$oligo_len)){die("Error: query sequence must be at least 4^(length of oligo) to proceed.");}


        // when frequencies at both strands are requested, place sequence and reverse complement of sequence in one line
        if ($strands==2){$sequence.=" ".RevComp($sequence); }

        // compute request and save data in an array
        $result=find_oligos($sequence,$oligo_len);

        // print the form
        print_form ($sequence);

        //print out results
        print "<p>Frequencie of oligos with length $oligo_len<br><textarea cols=60 rows=50>";
        foreach($result as $oligo => $frequency){
                print "$oligo\t$frequency\n";
        }
        print "\n</textarea>\n";

}


// ######################################################################################################
// #####################################        FUNCTIONS             ###################################
// ######################################################################################################
function print_form($sequence){
        print "<table bgcolor=DDDDFF cellpadding=10><tr><td>\n";
        print "<form method=post action=\"".$_SERVER["PHP_SELF"]."\">\n";
        print "<b>Copy your sequence in the textarea below</b>\n";
        print "<br><font size=-1>(non coding characters, as number, returns or spaces will be removed)</font>\n";
        print "<br><textarea name=sequence cols=60 rows=5>".chunk_split($sequence, 60)."</textarea>\n";
        print "<br>Select length of oligonucleotides\n";
        print "<select name=len>\n";
        print "<option>1\n";
        print "<option>2\n";
        print "<option>3\n";
        print "<option>4\n";
        print "<option>5\n";
        print "<option>6\n";
        print "<option>7\n";
        print "<option>8\n";
        print "</select>*\n";
        print "<br>Compute frequencies in \n";
        print "<select name=strands>\n";
        print "<option value=1>one strand\n";
        print "<option value=2>both strands";
        print "</select>\n";
        print "<br><input type=submit value=\"Find oligonucleotide frequencies\">\n";
        print "<br><font size=-1>This version does not work with degenerated nucleotides</font>\n";
        print "</form>\n";
        print "<font size=-1>* when selected length is one, frequency of nucleotides A, C, G and T will be reported.</font>\n";
        print "</td></tr></table>\n";
}

function find_oligos($sequence,$oligo_len){
        //for oligos 1 bases long
        if ($oligo_len==1){
                $oligos["A"] = substr_count($sequence,"A");
                $oligos["C"] = substr_count($sequence,"C");
                $oligos["G"] = substr_count($sequence,"G");
                $oligos["T"] = substr_count($sequence,"T");
                return $oligos;
        }

        //for oligos with at least two bases 2 bases
        $i=0;
        $len=strlen($sequence)-$oligo_len+1;
        while ($i<$len){
            $seq=substr($sequence,$i,$oligo_len);
            $oligos_1step[$seq]++;
            $i++;
        }
        $base_a=array("A","C","G","T");
        $base_b=$base_a;
        $base_c=$base_a;
        $base_d=$base_a;
        $base_e=$base_a;
        $base_f=$base_a;
        $base_g=$base_a;
        $base_h=$base_a;

        //for oligos 2 bases long
        if ($oligo_len==2){
            foreach($base_a as $key_a => $val_a){
                        foreach($base_b as $key_b => $val_b){
                         if ($oligos_1step[$val_a.$val_b]){
                                $oligos[$val_a.$val_b] = $oligos_1step[$val_a.$val_b];
                        }else{
                                $oligos[$val_a.$val_b] = 0;
                        }
                        }}
        }
        //for oligos 3 bases long
        if ($oligo_len==3){
                        foreach($base_a as $key_a => $val_a){
                        foreach($base_b as $key_b => $val_b){
                        foreach($base_c as $key_c => $val_c){
                        if ($oligos_1step[$val_a.$val_b.$val_c]){
                                $oligos[$val_a.$val_b.$val_c] = $oligos_1step[$val_a.$val_b.$val_c];
                        }else{
                                $oligos[$val_a.$val_b.$val_c] = 0;
                        }
                        }}}
        }
        //for oligos 4 bases long
        if ($oligo_len==4){
                        foreach($base_a as $key_a => $val_a){
                        foreach($base_b as $key_b => $val_b){
                        foreach($base_c as $key_c => $val_c){
                        foreach($base_d as $key_d => $val_d){
                            if ($oligos_1step[$val_a.$val_b.$val_c.$val_d]){
                                $oligos[$val_a.$val_b.$val_c.$val_d] = $oligos_1step[$val_a.$val_b.$val_c.$val_d];
                            }else{
                                $oligos[$val_a.$val_b.$val_c.$val_d] = 0;
                            }
                        }}}}
        }
        //for oligos 5 bases long
        if ($oligo_len==5){
                        foreach($base_a as $key_a => $val_a){
                        foreach($base_b as $key_b => $val_b){
                        foreach($base_c as $key_c => $val_c){
                        foreach($base_d as $key_d => $val_d){
                        foreach($base_e as $key_e => $val_e){
                            if ($oligos_1step[$val_a.$val_b.$val_c.$val_d.$val_e]){
                                $oligos[$val_a.$val_b.$val_c.$val_d.$val_e] = $oligos_1step[$val_a.$val_b.$val_c.$val_d.$val_e];
                            }else{
                                $oligos[$val_a.$val_b.$val_c.$val_d.$val_e] = 0;
                            }
                        }}}}}
        }
        //for oligos 6 bases long
        if ($oligo_len==6){
                        foreach($base_a as $key_a => $val_a){
                        foreach($base_b as $key_b => $val_b){
                        foreach($base_c as $key_c => $val_c){
                        foreach($base_d as $key_d => $val_d){
                        foreach($base_e as $key_e => $val_e){
                        foreach($base_f as $key_f => $val_f){
                            if ($oligos_1step[$val_a.$val_b.$val_c.$val_d.$val_e.$val_f]){
                                $oligos[$val_a.$val_b.$val_c.$val_d.$val_e.$val_f] = $oligos_1step[$val_a.$val_b.$val_c.$val_d.$val_e.$val_f];
                            }else{
                                $oligos[$val_a.$val_b.$val_c.$val_d.$val_e.$val_f] = 0;
                            }
                        }}}}}}
        }
        //for oligos 7 bases long
        if ($oligo_len==7){
                        foreach($base_a as $key_a => $val_a){
                        foreach($base_b as $key_b => $val_b){
                        foreach($base_c as $key_c => $val_c){
                        foreach($base_d as $key_d => $val_d){
                        foreach($base_e as $key_e => $val_e){
                        foreach($base_f as $key_f => $val_f){
                        foreach($base_g as $key_g => $val_g){
                            if ($oligos_1step[$val_a.$val_b.$val_c.$val_d.$val_e.$val_f.$val_g]){
                                $oligos[$val_a.$val_b.$val_c.$val_d.$val_e.$val_f.$val_g] = $oligos_1step[$val_a.$val_b.$val_c.$val_d.$val_e.$val_f.$val_g];
                            }else{
                                $oligos[$val_a.$val_b.$val_c.$val_d.$val_e.$val_f.$val_g] = 0;
                            }
                        }}}}}}}
        }
        //for oligos 8 bases long
        if ($oligo_len==8){
                        foreach($base_a as $key_a => $val_a){
                        foreach($base_b as $key_b => $val_b){
                        foreach($base_c as $key_c => $val_c){
                        foreach($base_d as $key_d => $val_d){
                        foreach($base_e as $key_e => $val_e){
                        foreach($base_f as $key_f => $val_f){
                        foreach($base_g as $key_g => $val_g){
                        foreach($base_h as $key_h => $val_h){
                            if ($oligos_1step[$val_a.$val_b.$val_c.$val_d.$val_e.$val_f.$val_g.$val_h]){
                                $oligos[$val_a.$val_b.$val_c.$val_d.$val_e.$val_f.$val_g.$val_h] = $oligos_1step[$val_a.$val_b.$val_c.$val_d.$val_e.$val_f.$val_g.$val_h];
                            }else{
                                $oligos[$val_a.$val_b.$val_c.$val_d.$val_e.$val_f.$val_g.$val_h] = 0;
                            }
                        }}}}}}}}
        }
        return $oligos;
}

// computes the reverse complement of a sequence (only ACGT nucleotides are used)
function RevComp($seq){
        $seq=strrev($seq);
        $seq=str_replace("A", "t", $seq);
        $seq=str_replace("T", "a", $seq);
        $seq=str_replace("G", "c", $seq);
        $seq=str_replace("C", "g", $seq);
        $seq = strtoupper ($seq);
return $seq;
}



?>
</center>
</body>
</html>
