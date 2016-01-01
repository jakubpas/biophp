<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>EQUATIONS</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
  <style>
   body{font-family: Verdana;}
   td{font-family: Verdana;}
   </style>
</body>

<?php

if( (!$_REQUEST['id1']) && (!$_REQUEST['id2']) && (!$_REQUEST['id3']) && (!$_REQUEST['id4'])&& 
    (!$_REQUEST['id5']) && (!$_REQUEST['id6']) && (!$_REQUEST['id7']) && (!$_REQUEST['id8'])  &&
    (!$_REQUEST['id9']) &&(!$_REQUEST['id10']) && (!$_REQUEST['id11']) && (!$_REQUEST['id12']) ){  
//print "<strong><h1><center>Working with DNA</center></h1></strong>";
?>
<font size=+2>
 <?php
 
//first page: working with DAN
print	"<table align='center' border='1' width =500>";
print  "<tr>";
print  "<th align='left'><font size='+2'>Working with DNA</font></th>";
print  "</tr>";
print  "<tr>";
print "   <td><a href='?&id1=pmolof_ssdna'>Calculation of molecular weight in Dalton</a></td>";
print "  </tr>";
print "<tr>";
print "<td><a href='?&id2=pmolof_dsdna'>Calculation of pmol of 5'(or3')ends</a></td>";
print "  </tr>";
print "<tr>";
print "<td><a href='?&id3=gtopof_dsdna'>Conversion of &micro;g to pmol</a></td>";
print "  </tr>";
print "<tr>";
print "<td><a href='?&id4=pmoltopof_dsdna'>Conversion of Pmol to &micro;g</a></td>";
print "  </tr>";
print "</table>";

//First page working with RNA
print	"<table align='center' border='1' width =500>";
print  "<tr>";
print  "<th align='left'><font size='+2'>Working with RNA</font></th>";
print  "</tr>";
print  "<tr>";
print "   <td><a href='?&id5=mw_of_ssrna'>Calculation of molecular weight in Dalton</a></td>";
print "  </tr>";
print "<tr>";
print "<td><a href='?&id6=pmolof_dsrna'>Calculation of pmol of 5'(or3')ends</a></td>";
print "  </tr>";
print "<tr>";
print "<td><a href='?&id7=gtopof_dsrna'>Conversion of &micro;g to pmol</a></td>";
print "  </tr>";
print "<tr>";
print "<td><a href='?&id8=pmoltopof_dsrna'>Conversion of Pmol to &micro;g</a></td>";
print "  </tr>";
print "</table>";

//First page working with Temperatures and Pressure
print	"<table align='center' border='1' width =500>";
print  "<tr>";
print  "<th align='left'><font size='+2'>working with Temperatures and  Pressure</font></th>";
print  "</tr>";
print  "<tr>";
print "   <td><a href='?&id9=conversion'>Conversions Between Centigrade and Fahrenheit </a></td>";
print "  </tr>";
print "<tr>";
print "<td><a href='?&id10=pmolof_dsrna'>From millibars (mbar) to different units</a></td>";
print "  </tr>";
print "</table>";

//Quantification of Proteins
print	"<table align='center' border='1' width =500>";
print  "<tr>";
print  "<th align='left'><font size='+2'>Quantification of Proteins</font></th>";
print  "</tr>";
print  "<tr>";
print "   <td><a href='?&id11=Molar_Proteins'>Molar conversions for Proteins</a></td>";
print "  </tr>";
print "<tr>";
print "<td><a href='?&id12=Protein_DNA '>Protein/DNA conversions (1 kb of DNA encodes 333 amino acids = 3.7 x 10 4 Da)</a></td>";
print "  </tr>";
print "</table>";


?>

<?php }else{
?>

<?php 

//first main equation
if($_REQUEST['id1'])
{
					
					
					if($_REQUEST[check]=='dsdna'){
					$MW_dsDNA_sequence=preg_replace('/[^ATGCYRWSKMDVHBN]/','',strtoupper($_REQUEST['sequence']));
					if(!(is_string($MW_dsDNA_sequence))){
					}
					$result=MW_of_dsDNA($MW_dsDNA_sequence);
					}
					
					if($_REQUEST[check]=='ssdna'){
					$MW_ssDNA_sequence=preg_replace('/[^ATGCYRWSKMDVHBN]/','',strtoupper($_REQUEST['sequence']));
					$result=MW_of_ssDNA($MW_ssDNA_sequence);
					}
				print "<form action='$_SERVER[PHP_SELF]' method='POST' >";
				print "<strong><h1><center>Molecular weight of DNA</center></h1></strong>";
					print"<table align='center' BGCOLOR='#ddddff' width='' border='0'>";
					print"  <tr> ";
					print "  <tr>";
					print "  </tr>";
					print"     <td>Enter a sequence here</td>";
					print"   </tr>";
					print"  <tr> ";
					print"     <td> </td>";
					print"   </tr>";
					print"   <tr>";
					print"     <td><textarea name='sequence' cols='70' rows='5'>" . $_POST['sequence'] ."</TEXTAREA></td>";
					print"   </tr>";
					print"   <tr>";
					print"  <tr> ";
					print "    <td align ='center' >";
					print " dsDNA <input type='radio' name='check' value='dsdna' CHECKED><br>";
					print " ssDNA <input type='radio' name='check' value='ssdna'>";
					print "</td>";
					print "  <tr>";
					if($result==0){
					print "   <td align='center'><font size='4'>&nbsp;</font></td>";
					}else{
					print "   <td align='center'><font size='4'>$result Dalton</font></td>";}
					print "  </tr>";
					print"   </tr>";
					print"   </tr>";
					print"     <td><input type='submit' value='Calculate' ></td>";
					print"   </tr>";
					print"  <tr> ";
					print"     <td> </td>";
					print"   </tr>";
					print" </table>";
				print "<br><center><a href=$_SERVER[PHP_SELF]>Home</a></center>";
				print "<input type='hidden' name='id1' value='mw_of_ssdna'><br>";
				print "</form>";
					
					
//eqution1 listed below
print	"<table align='center' border='0' cellspacing='10' cellpadding='0'>";
print "<tr>";
print "<td>MW of dsDNA = [number of basepairs] x [660 Da]</td>";
print "  </tr>";
print  "<tr>";
print "  </tr>";
print "<tr>";
print "<td>MW of ssDNA = [number of bases] x [330 Da]</td>";
print "  </tr>";
print "</table>";		
		 
}

//second main equation starts here
if($_REQUEST['id2'])
{
					
					if($_REQUEST[check]=='dsdna'){
					$pmol_dsDNA_sequence=preg_replace('/[^ATGCYRWSKMDVHBN]/','',strtoupper($_REQUEST['sequence']));
					$pmol_dsDNA_no_of_mueg=$_REQUEST['no_of_micro'];
					$result=pmol_of_dsDNA($pmol_dsDNA_sequence,$pmol_dsDNA_no_of_mueg);
					}
					
					if($_REQUEST[check]=='ssdna'){
					$pmol_ssDNA_sequence=preg_replace('/[^ATGCYRWSKMDVHBN]/','',strtoupper($_REQUEST['sequence']));
					$pmol_ssDNA_no_of_mueg=$_REQUEST['no_of_micro'];
					$result=pmol_of_ssDNA($pmol_ssDNA_sequence,$pmol_ssDNA_no_of_mueg);
					}
					
				print "<form action='$_SERVER[PHP_SELF]' method='POST' >";
				print "<strong><h1><center>Calculation of pmol of 5'(or3')ends of DNA</center></h1></strong>";
					print "	<table align='center' BGCOLOR='#ddddff' width='' border='0'>";
					print "  <tr>";
					print "  </tr>";
					print "  <tr>";
					print "    <td>Enter a sequence here </td>";
					print "  </tr>";
					print "    <td><textarea name='sequence' cols='80' rows='5'>" . $_POST['sequence'] ."</TEXTAREA></td>";
					print "  </tr>";
					print "  <tr>";
					print "    <td align ='center' >";
					print " dsDNA <input type='radio' name='check' value='dsdna' CHECKED><br>";
					print " ssDNA <input type='radio' name='check' value='ssdna'>";
					print "</td>";
					print "  </tr>";
					print "  <tr>";
					print "    <td>No of &micro;g's <input name='no_of_micro' type='text' size=7 id='t_field' value=$no_of_micro></td>";
					print "  </tr>";
					print "  <tr>";
					if($result==0){
					print "   <td align='center'><font size='4'>&nbsp;</font></td>";
					}else{
					print "   <td align='center'><font size='4'>$result</font></td>";}
					print "  </tr>";
					print "<tr>";
					print "  </tr>";
					print "<tr>";
					print "    <td align='left'><input name='micro_topmol_ssDNA_form' type='submit' value='Calculate'></td>";
					print "  </tr>";
					print "</table>";
				print "<br><center><a href='$_SERVER[PHP_SELF]'>Home</a></center>";
				print "<input type='hidden' name='id2' value='pmolof_ssdna'>";
				print "</form>";
				
		
//equation2 listed below
print	"<table align='center'   border='0' cellspacing='10' cellpadding='0'>";
print "<tr>";
print "<td>pmol of ends of a dsDNA molecule = 2 x 10<sup>6</sup> x &micro;g (of dsDNA)/Nbp x 660 Da</td>";
print "  </tr>";
print "<tr>";
print "<td>pmol of ends of a ssDNA molecule = 1 x 10<sup>6</sup> x &micro;g (of dsDNA)/Nbp x 330 Da</td>";
print "  </tr>";
print "</table>";
			 
}

//third main equation starts here
if($_REQUEST['id3'])
{
					
			
					if($_REQUEST[check]=='dsdna'){
					$pmol_dsDNA_sequence=preg_replace('/[^ATGCYRWSKMDVHBN]/','',strtoupper($_REQUEST['sequence']));
					$no_of_micro_dsDNA=$_REQUEST['no_of_micro'];
					$result=micro_to_pmol_dsDNA($pmol_dsDNA_sequence,$no_of_micro_dsDNA);
					}
					
					if($_REQUEST[check]=='ssdna'){
					$pmol_ssDNA_sequence=preg_replace('/[^ATGCYRWSKMDVHBN]/','',strtoupper($_REQUEST['sequence']));
					$no_of_micro_ssDNA=$_REQUEST['no_of_micro'];
					$result=micro_to_pmol_ssDNA($pmol_ssDNA_sequence,$no_of_micro_ssDNA);
					}
					
				print "<form action='$_SERVER[PHP_SELF]' method='POST' >";
				print "<strong><h1><center>Conversion of �g to pmol</center></h1></strong>";
					print "	<table align='center' BGCOLOR='#ddddff' width='' border='0'>";
					print "  <tr>";
					print "  </tr>";
					print "  <tr>";
					print "    <td>Enter a sequence here</td>";
					print "  </tr>";
					print "    <td><textarea name='sequence' cols='70' rows='5'>" . $_POST['sequence'] ."</TEXTAREA></td>";
					print "  </tr>";
					print "  <tr>";
					print "    <td align ='center' >";
					print " dsDNA <input type='radio' name='check' value='dsdna' CHECKED><br>";
					print " ssDNA <input type='radio' name='check' value='ssdna'>";
					print "</td>";
					print "  </tr>";
					print "  <tr>";
					print "    <td>No of &micro;g's :<input name='no_of_micro' type='text' size=7 id='t_field' value=$no_of_micro> </td>";
					print "  </tr>";
					print "  <tr>";
					if($result==0){
					print "   <td align='center'><font size='4'>&nbsp;</font></td>";
					}else{
					print "   <td align='center'><font size='4'>$result pmol</font></td>";}
					print "  </tr>";
					print "<tr>";
					print "    <td align='right'></td>";
					print "  </tr>";
					print "<tr>";
					print "    <td align='left'><input name='micro_topmol_ssDNA_form' type='submit' value='Calculate'></td>";
					print "  </tr>";
					print "</table>";
				print "<br><center><a href='$_SERVER[PHP_SELF]'>Home</a></center>";
				print "<input type='hidden' name='id3' value='pmolof_ssdna'>";
				print "</form>";
						
		
//equation3 listed below
print	"<table align='center'  border='0' cellspacing='10' cellpadding='0'>";
print "<td>pmol of dsDNA = &micro;g (of dsDNA) x 1,515/Nbp</td>";
print "  </tr>";
print "<tr>";
print "<td>pmol of ssDNA = �g (of ssDNA) x 3030/Nbp</td>";
print "  </tr>";
print "</table>";
			
}

//last main equation starts here
if($_REQUEST['id4'])
{
		
					if($_REQUEST[check]=='dsdna'){
					$micro_dsDNA_sequence=preg_replace('/[^ATGCYRWSKMDVHBN]/','',strtoupper($_REQUEST['sequence']));
					$no_of_pmol_dsDNA=$_REQUEST['no_of_micro'];
					$result=pmol_to_micro_dsDNA($micro_dsDNA_sequence,$no_of_pmol_dsDNA);
					}
					
					if($_REQUEST[check]=='ssdna'){
					$micro_ssDNA_sequence=preg_replace('/[^ATGCYRWSKMDVHBN]/','',strtoupper($_REQUEST['sequence']));
					$no_of_pmol_ssDNA=$_REQUEST['no_of_micro'];
					$result=pmol_to_micro_ssDNA($micro_ssDNA_sequence,$no_of_pmol_ssDNA);
					}
					
				print "<form action='$_SERVER[PHP_SELF]' method='POST'>";
				print "<strong><h1><center>Conversion of pmol to �g</center></h1></strong>";
					print "	<table align='center' BGCOLOR='#ddddff' width='' border='0'>";
					print "  <tr>";
					print "  </tr>";
					print "  <tr>";
					print "    <td>Enter a sequence here </td>";
					print "  </tr>";
					print "    <td><textarea name='sequence' cols='70' rows='5'>" . $_POST['sequence'] ."</TEXTAREA></td>";
					print "  </tr>";
					print "  <tr>";
					print "    <td align ='center' >";
					print " dsDNA <input type='radio' name='check' value='dsdna' CHECKED><br>";
					print " ssDNA <input type='radio' name='check' value='ssdna'>";
					print "</td>";
					print "  <tr>";
					print "    <td>No of pmols  :<input name='no_of_micro' type='text' size=7 ID='t_field' value=$no_of_micro></td>";
					print "  </tr>";
					print "  <tr>";
					if($result==0){
					print "   <td align='center'><font size='4'>&nbsp;</font></td>";
					}else{
					print "   <td align='center'><font size='4'>$result  �g</font></td>";}
					print "  </tr>";
					print "<tr>";
					print "    <td align='right'></td>";
					print "  </tr>";
					print "<tr>";
					print "    <td align='left'><input name='micro_topmol_ssDNA_form' type='submit' value='Calculate'></td>";
					print "  </tr>";
					print "</table>";
				print "<br><center><a href='$_SERVER[PHP_SELF]'>Home</a></center>";
				print "<input type='hidden' name='id4' value='pmolof_ssdna'>";
				print "</form>";
		
//equation4 listed below
print	"<table align='center' border='0' cellspacing='10' cellpadding='0'>";
print "<tr>";
print "<td>&micro;g of dsDNA = pmol (of dsDNA) x Nbp x 6.6 x 10<sup>-4</sup</td>";
print "  </tr>";
print "<tr>";
print "<td>&micro;g of ssDNA = pmol (of dsDNA) x Nbp x 3.3 x 10<sup>-4</sup></td>";
print "  </tr>";
print "</table>";

			 
}

//Working with RNA equations starts here
//first equation
if($_REQUEST['id5'])
{

					$MW_ssRNA_sequence=preg_replace('/[^ATGCYRWSKMDVHBN]/','',strtoupper($_REQUEST['sequence']));
					$result=MW_of_ssRNA($MW_ssRNA_sequence);
					
				print "<form action='$_SERVER[PHP_SELF]' method='POST' >";
				print "<strong><h1><center>Molecular weight of RNA</center></h1></strong>";
					print"<table align='center' BGCOLOR='#ddddff' width='' border='0'>";
					print"  <tr> ";
					print "  <tr>";
					print "  </tr>";
					print"     <td>Enter a sequence here</td>";
					print"   </tr>";
					print"  <tr> ";
					print"     <td> </td>";
					print"   </tr>";
					print"   <tr>";
					print"     <td><textarea name='sequence' cols='70' rows='5'>" . $_POST['sequence'] ."</TEXTAREA></td>";
					print"   </tr>";
					print"   <tr>";
					print"  <tr> ";
					print"     <td> </td>";
					print "  <tr>";
					if($result==0){
					print "   <td align='center'><font size='4'>&nbsp;</font></td>";
					}else{
					print "   <td align='center'><font size='4'>$result Dalton</font></td>";}
					print "  </tr>";
					print"   </tr>";
					print"   </tr>";
					print"     <td><input name='MW_of_ssRNA_form' type='submit' value='Calculate'></td>";
					print"   </tr>";
					print"  <tr> ";
					print"     <td> </td>";
					print"   </tr>";
					print" </table>";
				print "<br><center><a href=$_SERVER[PHP_SELF]>Home</a></center>";
				print "<input type='hidden' name='id5' value='mw_of_ssrna'><br>";
				print "</form>";
					
//eqution1 listed below
print	"<table align='center' border='0'>";
print "<tr>";
print "<td>MW of ssDNA = [number of basepairs] x [340 Da]</td>";
print "  </tr>";
print "</table>";		
			 
}

//Working with RNA second equation 
if($_REQUEST['id6'])
{
					
			
					
					$pmol_ssRNA_sequence=preg_replace('/[^ATGCYRWSKMDVHBN]/','',strtoupper($_REQUEST['sequence']));
					$pmol_ssRNA_no_of_mueg=$_REQUEST['no_of_micro'];
					$result=pmol_of_ssRNA($pmol_ssRNA_sequence,$pmol_ssRNA_no_of_mueg);
					
				print "<form action='$_SERVER[PHP_SELF]' method='POST' >";
				print "<strong><h1><center>Calculation of pmol of 5'(or3')ends of RNA</center></h1></strong>";
					print "	<table align='center' BGCOLOR='#ddddff' width='' border='0'>";
					print "  <tr>";
					print "  </tr>";
					print "  <tr>";
					print "    <td>Enter a sequence here </td>";
					print "  </tr>";
					print "    <td><textarea name='sequence' cols='80' rows='5'>" . $_POST['sequence'] ."</TEXTAREA></td>";
					print "  </tr>";
					print "    <td>No of &micro;g's  :<input name='no_of_micro' type='text' size=7 id='t_field' value=$no_of_micro></td>";
					print "  </tr>";
					print "  <tr>";
					if($result==0){
					print "   <td align='center'><font size='4'>&nbsp;</font></td>";
					}else{
					print "   <td align='center'><font size='4'>$result</font></td>";}
					print "  </tr>";
					print "<tr>";
					print "  </tr>";
					print "<tr>";
					print "    <td align='left'><input name='micro_topmol_ssRNA_form' type='submit' value='Calculate'></td>";
					print "  </tr>";
					print "</table>";
				print "<br><center><a href='$_SERVER[PHP_SELF]'>Home</a></center>";
				print "<input type='hidden' name='id6' value='pmolof_ssrna'>";
				print "</form>";
		
//equation listed below
print	"<table align='center'   border='0' cellspacing='10' cellpadding='0'>";
print "<tr>";
print "<td>pmol of ends of a ssRNA molecule =&micro;g (of ssRNA)*2941/Nbp</td>";
print "  </tr>";
print "</table>";
			 
}
//Working with RNA third equation 
if($_REQUEST['id7'])
{
					
							
					$pmol_ssRNA_sequence=preg_replace('/[^ATGCYRWSKMDVHBN]/','',strtoupper($_REQUEST['sequence']));
					$pmol_ssRNA_no_of_mueg=$_REQUEST['no_of_micro'];
					$result=pmol_of_ssRNA($pmol_ssRNA_sequence,$pmol_ssRNA_no_of_mueg);
					
				print "<form action='$_SERVER[PHP_SELF]' method='POST' >";
				print "<strong><h1><center>Conversion of �g to pmol</center></h1></strong>";
					print "	<table align='center' BGCOLOR='#ddddff' width='' border='0'>";
					print "  <tr>";
					print "  </tr>";
					print "  <tr>";
					print "    <td>Enter a sequence here</td>";
					print "  </tr>";
					print "    <td><textarea name='sequence' cols='70' rows='5'>" . $_POST['sequence'] ."</TEXTAREA></td>";
					print "  </tr>";
					print "  <tr>";
					print "    <td>No of &micro;g's  :<input name='no_of_micro' type='text' size=7 id='t_field' value=$no_of_micro></td>";
					print "  </tr>";
					print "  <tr>";
					if($result==0){
					print "   <td align='center'><font size='4'>&nbsp;</font></td>";
					}else{
					print "   <td align='center'><font size='4'>$result pmol</font></td>";}
					print "  </tr>";
					print "<tr>";
					print "    <td align='right'></td>";
					print "  </tr>";
					print "<tr>";
					print "    <td align='left'><input name='micro_topmol_ssRNA_form' type='submit' value='Calculate'></td>";
					print "  </tr>";
					print "</table>";
				print "<br><center><a href='$_SERVER[PHP_SELF]'>Home</a></center>";
				print "<input type='hidden' name='id7' value='pmolof_ssrna'>";
				print "</form>";
		
//equation3 listed below
print	"<table align='center'  border='0' cellspacing='10' cellpadding='0'>";
print "<tr>";
print "<td>pmol of ssRNA = �g (of ssRNA) x 2914/Nbp</td>";
print "  </tr>";
print "</table>";
			 
}
//working with RNA last equation
if($_REQUEST['id8'])
{	
					
					$micro_ssRNA_sequence=preg_replace('/[^ATGCYRWSKMDVHBN]/','',strtoupper($_REQUEST['sequence']));
					$no_of_pmol_ssRNA=$_REQUEST['no_of_micro'];
					$result=pmol_to_micro_ssRNA($micro_ssRNA_sequence,$no_of_pmol_ssRNA);
					
				print "<form action='$_SERVER[PHP_SELF]' method='POST' >";
				print "<strong><h1><center>Conversion of pmol to �g</center></h1></strong>";
					print "	<table align='center' BGCOLOR='#ddddff' width='' border='0'>";
					print "  <tr>";
					print "  </tr>";
					print "  <tr>";
					print "    <td>Enter a sequence here </td>";
					print "  </tr>";
					print "    <td><textarea name='sequence' cols='70' rows='5'>" . $_POST['sequence'] ."</TEXTAREA></td>";
					print "  </tr>";
					print "  <tr>";
					print "    <td>No of pmols  :<input name='no_of_micro' type='text' size=7 id='t_field' value=$no_of_micro></td>";
					print "  </tr>";
					print "  <tr>";
					if($result==0){
					print "   <td align='center'><font size='4'>&nbsp;</font></td>";
					}else{
					print "   <td align='center'><font size='4'>$result  �g</font></td>";}
					print "  </tr>";
					print "<tr>";
					print "    <td align='right'></td>";
					print "  </tr>";
					print "<tr>";
					print "    <td align='left'><input name='micro_topmol_ssRNA_form' type='submit' value='Calculate'></td>";
					print "  </tr>";
					print "</table>";
				print "<br><center><a href='$_SERVER[PHP_SELF]'>Home</a></center>";
				print "<input type='hidden' name='id8' value='pmolof_ssrna'>";
				print "</form>";
		
//equation4 listed below
print	"<table align='center' border='0' cellspacing='10' cellpadding='0'>";
print "<tr>";
print "<td>&micro;g of ssDNA = pmol (of ssRNA) x Nbp x 3.4 x 10<sup>-4</sup></td>";
print "  </tr>";
print "</table>";
}

//First page working with Temperatures and Pressure first equation
if($_REQUEST['id9'])
{
					
			
					if($_REQUEST[check]=='CtoF'){
					$centigrade=$_REQUEST['value'];
					$result=centi_to_fahren($centigrade);
					}
					
					if($_REQUEST[check]=='FtoC'){
					$fahren=$_REQUEST['value'];
					$result=farhen_to_centi($fahren);
					}
					
				print "<form action='$_SERVER[PHP_SELF]' method='POST' >";
				print "<strong><h1><center>Conversions Between Centigrade and Fahrenheit</center></h1></strong>";
					print"<table align='center'  width='600' BGCOLOR='#ddddff' width='' border=' 0' >";
					print"  <tr> ";
					print "  <tr>";
					print"  <tr> ";
					print"     <td></td>";
					print"   </tr>";
					print"   <tr>";
					//print "    <td><textarea name='sequence' cols='70' rows='5'>" . $_POST['sequence'] ."</TEXTAREA></td>";
					print "    <td align='center'> Enter the value  :<input name='value' type='text' size=10  value=$value></td>";
					print"   </tr>";
					print"   <tr>";
					print"  <tr> ";
					print "    <td align ='center' >";
					print " From Centigrade to Fahrenheit <input type='radio' name='check' value='CtoF' CHECKED><br>";
					print " From Fahrenheit to Centigrade<input type='radio' name='check' value='FtoC'>";
					print "</td>";
					print "  <tr>";
					if($result==0){
					print "   <td align='center'><font size='4'>&nbsp;</font></td>";
					}else{
					print "   <td align='center'><font size='4'>$result </font></td>";}
					print "  </tr>";
					print"   </tr>";
					print"   </tr>";
					print"     <td align='center'><input type='submit' value='Calculate' ></td>";
					print"   </tr>";
					print"  <tr> ";
					print"     <td> </td>";
					print"   </tr>";
					print" </table>";
				print "<br><center><a href=$_SERVER[PHP_SELF]>Home</a></center>";
				print "<input type='hidden' name='id9' value='conversion'><br>";
				print "</form>";
					
					
//eqution1 listed below
print	"<table align='center' border='0' cellspacing='10' cellpadding='0'>";
print "<tr>";
print "<td>F&deg; = 32 + (C&deg; x 0.555)</td>";
print "  </tr>";
print  "<tr>";
print "  </tr>";
print "<tr>";
print "<td>C&deg; = 0.555 x (F&deg;-32)</td>";
print "  </tr>";
print "</table>";		
		 
}

//First page working with Temperatures and Pressure Second equation
if($_REQUEST['id10'])
{
					switch($_REQUEST[check]){
						case ('mbar_mm_Hgto'):
						$Hg=$_REQUEST['value'];
						$result=mbar_to_mmHg($Hg);
						break;
					case ('mbar_inch_Hg'):
						$inchHg=$_REQUEST['value'];
						$result=mbar_to_inchHg($inchHg);
						break;
					case ('mbar_psi'):
						$psi=$_REQUEST['value'];
						$result=mbar_to_psi($psi);
						break;
					case ('mbar_atm'):
						$atm=$_REQUEST['value'];
						$result=mbar_to_atm($atm);
						break;
					case ('mbar_kPa'):
						$kPa=$_REQUEST['value'];
						$result=mbar_to_kPa($kPa);
						break;
					case ('mbar_Torr'):
						$torr=$_REQUEST['value'];
						$result=mbar_to_Torr($torr);
						break;
					}
			
					/*if($_REQUEST[check]=='mbar_mm_Hgto'){
					$Hg=$_REQUEST['value'];
					$result=mbar_to_mmHg($Hg);
					//$result=centi_to_fahren($centigrade);
					}*/
					
					/*if($_REQUEST[check]=='mbar_inch_Hg'){
					$fahren=$_REQUEST['value'];
					$result=farhen_to_centi($fahren);
					}*/
					
				print "<form action='$_SERVER[PHP_SELF]' method='POST' >";
				print "<strong><h1><center>From millibars (mbar) to different units</center></h1></strong>";
					print"<table align='center'  width='600' BGCOLOR='#ddddff' width='' border='0' >";
					
					print"   <tr>";
					print "    <td align='right'>Enter the value  :</td><td><input name='value' type='text' size=15  value=$value></td>";
					print"   </tr>";
					print"  <tr> ";
					print "    <td align ='right' width='30'>";
					print " Millimeters of mercury (mm Hg)</td><td align='left' width='50%'> <input type='radio' name='check' value='mbar_mm_Hgto' CHECKED></td>";
					print "<tr>";
					print " <td align ='right'>Inches of mercury (inch Hg)</td><td align ='left'><input type='radio' name='check' value='mbar_inch_Hg'></td>";
					print "</tr>";
					print "<tr>";
					print " <td align ='right'>Pounds per square inch (psi)</td><td align ='left'><input type='radio' name='check' value='mbar_psi'></td>";
					print "</tr>";
					print "<tr>";
					print " <td align ='right'>Atmospheres (atm)</td><td align ='left'><input type='radio' name='check' value='mbar_atm'></td>";
					print "</tr>";
					print "<tr>";
					print " <td align ='right'>kilopascals (kPa)</td><td align ='left'><input type='radio' name='check' value='mbar_kPa'></td>";
					print "</tr>";
					print "<tr>";
					print " <td align ='right'>Torrs (Torr)</td><td align ='left'><input type='radio' name='check' value='mbar_Torr'></td>";
					print "</tr>";
					print "  <tr>";
					if($result==0){
					print "   <td align='right' width=''>&nbsp;<font size='4'></font></td>";
					}else{
					print "   <td align='right' ><font size='4'>$result </font></td>";}
					print "  </tr>";
					print"   </tr>";
					print"   </tr>";
					print"     <td align='right'><input type='submit' value='Calculate' ></td>";
					print"   </tr>";
					print"  <tr> ";
					print"     <td> </td>";
					print"   </tr>";
					print" </table>";
				print "<br><center><a href=$_SERVER[PHP_SELF]>Home</a></center>";
				print "<input type='hidden' name='id10' value='conversion'><br>";
				print "</form>";
					
					
//eqution1 listed below
print	"<table align='center' border='0' cellspacing='10' cellpadding='0'>";
print "<tr>";
print "<td>From millibars (mbar) to Millimeters of mercury (mm Hg) = mbar x 0.750000</td>";
print "  </tr>";
print "<tr>";
print "<td>From millibars (mbar) to Inches of mercury (inch Hg) = mbar x 0.039400</td>";
print "  </tr>";
print "<tr>";
print "<td>From millibars (mbar) to Pounds per square inch (psi) = mbar x 0.014500</td>";
print "  </tr>";
print "<tr>";
print "<td>From millibars (mbar) to Atmospheres (atm) = mbar x 0.000987</td>";
print "  </tr>";
print "<tr>";
print "<td>From millibars (mbar) to kilopascals (kPa) = mbar x 0.100000</td>";
print "  </tr>";
print "<tr>";
print "<td>From millibars (mbar) to Torrs (Torr) = mbar x 0.750000</td>";
print "  </tr>";
print "</table>";		
		 
}

//Quantification of Proteins equations
if($_REQUEST['id11']){
	print "<br><br><br><br><br>";
	print"<table align='center'  width='600' BGCOLOR='#ddddff' width='' border='1' >";
	print "<tr><th>Molar conversions for Proteins</th></tr></table>";
	//print "<tr><th>Molar conversions for Proteins</th></tr></table>";
	print"<table align='center'  width='600' BGCOLOR='#ddddff' width='' border='1' >";
	print "<th align='center'>100 pmol Protein </th>";
	print "<th align='center'>&micro;g Protein</th>";
	print "<tr>";
	print "<td align='center'>10 kDa</td>";
	print "<td align='center'>1</td>";
	print "</tr>";
	print "<tr>";	
	print "<td align='center'>30 kDa</td>";
	print "<td align='center'>3</td>";
	print "</tr>";
	print "<tr>";
	print "<td align='center'>100 kDa</td>";
	print "<td align='center'>10</td>";
	print "</tr>";
	//print "</tr>";
	print "</table>";
	print "<br><center><a href=$_SERVER[PHP_SELF]>Home</a></center>";
			}
if($_REQUEST['id12']){
	print "<br><br><br><br><br>";
	print"<table align='center'  width='600' BGCOLOR='#ddddff' width='' border='1' >";
	print "<tr><th>Protein/DNA conversions (1 kb of DNA encodes 333 amino acids = 3.7 x 10 4 Da)</th></tr></table>";
	print"<table align='center'  width='600' BGCOLOR='#ddddff' width='' border='1' >";
	print "<th align='center'>Protein </th>";
	print "<th align='center'>DNA</th>";
	print "<tr>";
	print "<td align='center'>10 kDa</td>";
	print "<td align='center'>270 bp</td>";
	print "</tr>";
	print "<tr>";
	print "<td align='center'>30 kDa</td>";
	print "<td align='center'>810 bp</td>";
	print "</tr>";
	print "<tr>";
	print "<td align='center'>100 kDa</td>";
	print "<td align='center'>2.7 bp</td>";
	print "</tr>";
	//print "</tr>";
	print "</table>";
	print "<br><center><a href=$_SERVER[PHP_SELF]>Home</a></center>";
}




}
//All functions of DNA
function MW_of_dsDNA($sequence){
		$no_base_pair=strlen($sequence);
		return ($no_base_pair*660);
}

function MW_of_ssDNA($sequence){
		$no_base_pair=strlen($sequence);
		return ($no_base_pair*330);
}
 
function pmol_of_dsDNA($pmol_dsDNA_sequence,$pmol_dsDNA_no_of_mueg){
		$no_base_pair=strlen($pmol_dsDNA_sequence);
		$number_of_mueg=$pmol_dsDNA_no_of_mueg;
		if(!$no_base_pair || !$number_of_mueg){
		return 0;
		}else{
		return ((2*pow(10,6))*($number_of_mueg)/(($no_base_pair)*660));
		}
}
function pmol_of_ssDNA($pmol_ssDNA_sequence,$pmol_ssDNA_no_of_mueg){
		$no_base_pair=strlen($pmol_ssDNA_sequence);
		$number_of_mueg=$pmol_ssDNA_no_of_mueg;
		if(!$no_base_pair || !$number_of_mueg){
		return 0;
		}else{
		return (1*pow(10,6)*$number_of_mueg/(($no_base_pair)*330));
		}
}

function micro_to_pmol_dsDNA($pmol_dsDNA_sequence,$no_of_micro_dsDNA){
	$no_base_pair=strlen($pmol_dsDNA_sequence);
	$number_of_micro=$no_of_micro_dsDNA;
		if(!$no_base_pair || !$number_of_micro){
		return 0;
		}else{
		return (($number_of_micro*1515)/$no_base_pair);}
}

function micro_to_pmol_ssDNA($pmol_ssDNA_sequence,$no_of_micro_ssDNA){
	$no_base_pair=strlen($pmol_ssDNA_sequence);
	$number_of_micro=$no_of_micro_ssDNA;
		if(!$no_base_pair || !$number_of_micro){
		return 0;
		}else{
		return (($number_of_micro*3030)/$no_base_pair);
		}

}

function pmol_to_micro_dsDNA($micro_dsDNA_sequence,$no_of_pmol_dsDNA){
	$no_base_pair=strlen($micro_dsDNA_sequence);
	$number_of_micro=$no_of_pmol_dsDNA;
		if(!$no_base_pair || !$number_of_micro){
		return 0;
		}else{
		return ($number_of_micro*$no_base_pair*(6.6*pow(10,(-4))));
		}

}
function pmol_to_micro_ssDNA($micro_ssDNA_sequence,$no_of_pmol_ssDNA){
	$no_base_pair=strlen($micro_ssDNA_sequence);
	$number_of_micro=$no_of_pmol_ssDNA;
		if(!$no_base_pair || !$number_of_micro){
		return 0;
		}else{
		return ($number_of_micro*$no_base_pair*(3.3*pow(10,(-4))));
		}
} 

//All functions of RNA  
function MW_of_ssRNA($sequence){
		$no_base_pair=strlen($sequence);
		return ($no_base_pair*340);
}  
//same for both second & third equation 
function pmol_of_ssRNA($pmol_ssRNA_sequence,$pmol_ssRNA_no_of_mueg){
		$no_base_pair=strlen($pmol_ssRNA_sequence);
		$number_of_mueg=$pmol_ssRNA_no_of_mueg;
		if(!$no_base_pair || !$number_of_mueg){
		return 0;
		}else{
		return (($number_of_mueg*2941)/($no_base_pair));
		}
}  
function pmol_to_micro_ssRNA($micro_ssRNA_sequence,$no_of_pmol_ssRNA){
	$no_base_pair=strlen($micro_ssRNA_sequence);
	$number_of_micro=$no_of_pmol_ssRNA;
		if(!$no_base_pair || !$number_of_micro){
		return 0;
		}else{
		return ($number_of_micro*$no_base_pair*(3.4*pow(10,(-4))));
		}
} 

function  centi_to_fahren($centigrade){
		
		if(!$centigrade){
		return 0;
		}else{
return  (32+($centigrade*0.555));
		}
}
function  farhen_to_centi($fahren){
		if(!$fahren){
		return 0;
		}else{
return  (0.555*($fahren-32));
		}
}
function mbar_to_mmHg($Hg){
if(!$Hg){
		return 0;
		}else{
return  (0.750000*($Hg));
		}
}
function mbar_to_inchHg($inchHg){
if(!$inchHg){
		return 0;
		}else{
return  (0.039400*($inchHg));
		}
}
function mbar_to_psi($psi){
if(!$psi){
		return 0;
		}else{
return  (0.014500*($psi));
		}
}
function mbar_to_atm($atm){
if(!$atm){
		return 0;
		}else{
return  (0.000987*($atm));
		}
}
function mbar_to_kPa($kPa){
if(!$kPa){
		return 0;
		}else{
return  (0.100000*($kPa));
		}
}
function mbar_to_Torr($torr){
if(!$torr){
		return 0;
		}else{
return  (0.750000*($torr));
		}
}

function revpermin($rpm,$RCF,$R){
//return 100000000;
$rcf=1.12*$R*(pow(( $rpm/1000),2) );
//print $rcf;
$temp=($rcf / (1.12*$R));
print $temp;
$res=1000*( sqrt($temp) );
return ($res);
}


?>
</body>
</html>
