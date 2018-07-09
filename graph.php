<?php
     //graph
    class Graph{
        private $v;//vertices
        private $adjList;//adjacent list
        public function __construct($vertices){
            $this->v=$vertices;
            $this->initAdjList();
        }

        //@suppressWarnings("unchecked")
        private function initAdjList(){
            $this->adjList = array($this->v);
            for($i=0; $i<$this->v;$i++){
                $this->adjList[$i]=array();
            }
        }

        public function addEdge($u, $v){
            array_push($this->adjList[$u],$v);
        }

        public function printAllPaths($s, $d){
            $isVisted=array();
            $isVisted=array_fill(0,$this->v,false);
            $pathList=array();
            array_push($pathList,$s);
            $this->printAllPathsUtil($s, $d, $isVisted,$pathList);
        }

        private function printAllPathsUtil($u,$d,$isVisted,$localPathList){
            $isVisted[$u]=true;

            if($u==$d){
               // echo $localPathList;
                print_r($localPathList);
            }

            foreach ($this->adjList[$u] as $i){
                if(!$isVisted[$i]){
                    array_push($localPathList,$i);
                    $this->printAllPathsUtil($i, $d, $isVisted, $localPathList);

                    array_splice($localPathList,$i,1);

                }
            }
            $isVisted[$u]=false;
        }
    }

    $g=new Graph(5);
    $g->addEdge(0,1);
    $g->addEdge(0,2);
    $g->addEdge(0,3);
    $g->addEdge(2,0);
    $g->addEdge(2,1);
    $g->addEdge(1,3);
    $g->addEdge(3,1);
    $g->addEdge(3,2);
    $g->addEdge(4,3);
    $g->addEdge(3,4);
    $s=0;
    $d=4;
    $g->printAllPaths($s,$d);

    /* Expected output :
    0 3 4
    0 1 3 4
    0 2 1 3 4
    */

?>
