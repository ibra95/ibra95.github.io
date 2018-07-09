
<?php
//creates 6 arrays with visited =0 and
$graph = [];
$visited = [];
$vertexCount = 6;
for($i = 1;$i<=$vertexCount;$i++) {
  //array_fill(staryt_index, number of values , value of every index )
  //
$graph[$i] = array_fill(1, $vertexCount, 0);//make 6 arrays from 1 to 6 allhave indexex from 1 to 6 with value 0
$visited[$i] = 0;//array for visited nodes , set all as zero index
}
//uniderction graph 's edges
//adjacency matrix to represent the graph
$graph[1][2] = $graph[2][1] = 1;
$graph[1][5] = $graph[5][1] = 1;
$graph[5][2] = $graph[2][5] = 1;
$graph[5][4] = $graph[4][5] = 1;
$graph[4][3] = $graph[3][4] = 1;
$graph[3][2] = $graph[2][3] = 1;
$graph[6][4] = $graph[4][6] = 1;


function DFS(array &$graph, int $start,int $end, array $visited): SplQueue {
$stack = new SplStack;
$path = new SplQueue;
$stack->push($start);//push start node
$visited[$start] = 1;
while (!$stack->isEmpty()) {
$node = $stack->pop();
$path->enqueue($node);
foreach ($graph[$node] as $key => $vertex) {
if (!$visited[$key] && $vertex == 1 ) {
$visited[$key] = 1;
$stack->push($key);
}
}
}

return $path;
}




$path = DFS($graph,1,4, $visited);
while (!$path->isEmpty()) {
echo $path->dequeue()."\t";
}

print_r($path);

//now time for search algorithm
