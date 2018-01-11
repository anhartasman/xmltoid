<?php
$skripxml=$_POST['skripxml'];
$sxe = new SimpleXMLElement($skripxml);
$rootview="rootview.";
$rootview="";
function get_names1($node) {
    $names = array();
    foreach ($node->childNodes as $child) {
        if ($child->nodeType == 1) {
            $namaelemen=$child->nodeName;
            $names[] = $namaelemen;
            if($child->getAttribute('android:id')!=null){
              $idnya=$child->getAttribute('android:id');
              $pecah=explode("/", $idnya);
              $id=$pecah[1];
            echo $namaelemen." ".$id."=null;<br>";
          }else{

          }


            if ($child->hasChildNodes()) {
                $names[] = get_names1($child);
            }
        }
    }
    return array_filter($names);
}


function get_names2($node) {
    $names = array();
    foreach ($node->childNodes as $child) {
        if ($child->nodeType == 1) {
            $namaelemen=$child->nodeName;
            $names[] = $namaelemen;
            if($child->getAttribute('android:id')!=null){
              $idnya=$child->getAttribute('android:id');
              $pecah=explode("/", $idnya);
              $id=$pecah[1];
            echo "$id= ($namaelemen)$rootview"."findViewById(R.id.$id);<BR>";


          }else{

          }


            if ($child->hasChildNodes()) {
                $names[] = get_names2($child);
            }
        }
    }
    return array_filter($names);
}


function get_names3($node) {
    $names = array();
    foreach ($node->childNodes as $child) {
        if ($child->nodeType == 1) {
            $namaelemen=$child->nodeName;
            $names[] = $namaelemen;
            if($child->getAttribute('android:id')!=null){
              $idnya=$child->getAttribute('android:id');
              $pecah=explode("/", $idnya);
              $id=$pecah[1];

            $lanjut=1;
            $myfile = fopen($namaelemen, "r") or $lanjut=0;
            if($lanjut==1){
            $isi=fread($myfile,filesize($namaelemen));
            $isi=nl2br($isi);
            $isi=str_replace("#namaid#",$id,$isi);
            $isi=str_replace("Array","",$isi);
            echo $isi;
            fclose($myfile);
            }

          }else{

          }


            if ($child->hasChildNodes()) {
                $names[] = get_names3($child);
            }
        }
    }
    return array_filter($names);
}

$names = get_names1( DOMDocument::loadXML($skripxml)->firstChild );
echo "<BR>";
$namesa = get_names2( DOMDocument::loadXML($skripxml)->firstChild );
echo "<BR>";
$namesaa = get_names3( DOMDocument::loadXML($skripxml)->firstChild );
echo "<BR>";


 ?>
