<?php
$oprocess=array();
$row = 1;
if (($handle = fopen("t.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

    	$oprocess[]=$data;
    }
    fclose($handle);
}

$inputd=array();
if (isset($argc)) {

	for ($i = 1; $i < $argc; $i++) {
		$inputd[]=$argv[$i];
	}


}
else {
	echo "argc and argv disabled\n";
}

//print_r($inputd);


class Dijkstra
{
  protected $graph;
  protected $pathque,$source,$target,$qarray,$count;
  public function __construct($graph) {

    $this->graph = $graph;

  }

protected function searchForStart($source) {
	$dqarray=array();

   foreach ($this->graph as $key => $val) {
       if ($val[0] === $source) {

       	$dqarray[] = $val;

       	// $this->source=$val[1];
        // return $val;
       }
   }
   
   if(count($dqarray)>0){
   	usort($dqarray, array('Dijkstra','shortvalue'));
   	$this->source=$dqarray[0][1];
   	$this->count[]=$dqarray[0][1];
   	return $dqarray[0];
   }  else {
   	return null;	
   }
   
}

protected function shortvalue($a, $b)
{
	return $a[2] - $b[2];
}


  public function shortestPath($source, $target) {

  	$this->source=$source;

  	
  	$re=$this->searchForStart($source);

  	while ($re[1]!==$target) {
  		$this->pathque[]=$re;
		$re=$this->searchForStart($this->source);
  	}



  	if($re[1]==$target){
  		$this->pathque[]=$re;
  	}

  	$distance=0;
  	foreach($this->pathque as $key=>$value){
  		$this->finalarray[]=$value[0];
  		$distance+=$value[2];
  	}
  	$this->finalarray[]=$target;
  	$this->finalarray[]=$distance;
  	echo implode("=>",$this->finalarray);
  }

}

//$inputd=array('A','E');

//echo '<pre>';print_r($oprocess); die;

$g = new Dijkstra($oprocess);

$g->shortestPath($inputd[0], $inputd[1]);