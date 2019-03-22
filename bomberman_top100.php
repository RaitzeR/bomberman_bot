<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/
function sortByOrder($a, $b) {
    return $a[2] - $b[2];
}
function bombsHit($map,$bombs) {

    $hitarray = array();
    $hitarray_new = array();
    $intarray = array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14");
    $bombpositions = array();
    foreach($bombs as $bomb) {
        $bombpositions[$bomb[0].",".$bomb[1]] = array($bomb[0],$bomb[1],$bomb[2],$bomb[3]);
    }
    //error_log(var_export("Bomb Positions", true));
    //error_log(var_export($bombpositions, true));
    usort($bombpositions, 'sortByOrder');
    foreach($bombpositions as $bomb) {
        $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$bomb[1]] = $bomb[2];
        if(isset($hitarray[$bomb[0].",".$bomb[1]]["b"])) {
            $currb = $hitarray[$bomb[0].",".$bomb[1]]["b"];
            //error_log(var_export("CurrB: $currb - BombX: ".$bomb[0]." BombY: ".$bomb[1], true));                 
        } else {
            $currb = $bomb[2];
        }
        //error_log(var_export("BombX: ".$bomb[0]." BombY: ".$bomb[1]." BombTimer: ".$bomb[2], true));    
        $checkleft = true;
        $checkright = true;
        $checkup = true;
        $checkdown = true;
        
        $blastradius = $bomb[3];
        
        for ($i=1; $i < $blastradius; $i++) {

            if($checkleft) {
                $blast = $bomb[0]-$i;
                if(isset($map[$bomb[1]][$blast])) {
                    if($i == 1) {
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                        }
                    }
                    if($map[$bomb[1]][$blast] == "p"){
                        //Hits player
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                        }
                        $checkleft = false;
                    } elseif($map[$bomb[1]][$blast] == ".") {
                        //No hit
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                        }
                    } elseif($map[$bomb[1]][$blast] == "b") {
                        //Hits another bomb
                        
                            $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                            if(isset($hitarray[$blast.",".$bomb[1]]["b"])){
                                //error_log(var_export("B Already SET!", true));
                                $oldb = $hitarray[$blast.",".$bomb[1]]["b"];
                                $newb = $bomb[2];
                                //error_log(var_export("Old B: $oldb - New B: $newb - BombX".$bomb[0]." BombY: $blast - CurrB: $currb", true));
                                if($oldb > $newb) {
                                    $hitarray[$blast.",".$bomb[1]]["b"] = $newb;
                                } elseif($oldb > $currb) {
                                    $hitarray[$blast.",".$bomb[1]]["b"] = $currb;
                                }
                            } else {
                                if($bomb[2] > $currb) {
                                    $hitarray[$blast.",".$bomb[1]]["b"] = $currb;
                                } else {
                                    $hitarray[$blast.",".$bomb[1]]["b"] = $bomb[2];
                                }
                            }
                        
                        $checkleft = false;
                    } elseif(in_array($map[$bomb[1]][$blast],$intarray)) {
                        //HIT!
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                        }
                        $checkleft = false;
                    } else {
                        //Hit a wall
                        $checkleft = false;
                    }
                } else {
                    //Out of bounds
                    $checkleft = false;
                }
            }
            if($checkright) {
                $blast = $bomb[0]+$i;
                if(isset($map[$bomb[1]][$blast])) {
                    if($i == 1) {
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                        }
                    }
                    if($map[$bomb[1]][$blast] == "p"){
                        //Hits player
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                        }
                        $checkright = false;
                    } elseif($map[$bomb[1]][$blast] == ".") {
                        //No hit
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                        }
                    } elseif($map[$bomb[1]][$blast] == "b") {
                        //Hits another bomb
                        $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];

                        if(isset($hitarray[$blast.",".$bomb[1]]["b"])){
                            //error_log(var_export("B Already SET!", true));
                            $oldb = $hitarray[$blast.",".$bomb[1]]["b"];
                            $newb = $bomb[2];
                            //error_log(var_export("Old B: $oldb - New B: $newb - BombX".$bomb[0]." BombY: $blast - CurrB: $currb", true));
                            if($oldb > $newb) {
                                $hitarray[$blast.",".$bomb[1]]["b"] = $newb;
                            } elseif($oldb > $currb) {
                                $hitarray[$blast.",".$bomb[1]]["b"] = $currb;
                            }
                        } else {
                            if($bomb[2] > $currb) {
                                $hitarray[$blast.",".$bomb[1]]["b"] = $currb;
                            } else {
                                $hitarray[$blast.",".$bomb[1]]["b"] = $bomb[2];
                            }
                        }

                        $checkright = false;
                    } elseif(in_array($map[$bomb[1]][$blast],$intarray)) {
                        //HIT!
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$blast.",".$bomb[1]] = $bomb[2];
                        }
                        $checkright = false;
                    } else {
                        //Hit a wall
                        $checkright = false;
                    }
                } else {
                    //Out of bounds
                    $checkright = false;
                }
            }
            if($checkup) {
                $blast = $bomb[1]-$i;
                if(isset($map[$blast][$bomb[0]])) {
                    if($i == 1) {
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                        }
                    }
                    if($map[$blast][$bomb[0]] == "p"){
                        //Hits player
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                        }
                        $checkup = false;
                    } elseif($map[$blast][$bomb[0]] == ".") {
                        //No hit
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                        }
                    } elseif($map[$blast][$bomb[0]] == "b") {
                        //Hits another bomb
                        $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];

                        if(isset($hitarray[$bomb[0].",".$blast]["b"])){
                            //error_log(var_export("B Already SET!", true));
                            $oldb = $hitarray[$bomb[0].",".$blast]["b"];
                            $newb = $bomb[2];
                            //error_log(var_export("Old B: $oldb - New B: $newb - BombX".$bomb[0]." BombY: $blast - CurrB: $currb", true));
                            if($oldb > $newb) {
                                $hitarray[$bomb[0].",".$blast]["b"] = $newb;
                            } elseif($oldb > $currb) {
                                $hitarray[$bomb[0].",".$blast]["b"] = $currb;
                            }
                        } else {
                            if($bomb[2] > $currb) {
                                $hitarray[$bomb[0].",".$blast]["b"] = $currb;
                            } else {
                                $hitarray[$bomb[0].",".$blast]["b"] = $bomb[2];
                            }
                        }

                        $checkup = false;
                    } elseif(in_array($map[$blast][$bomb[0]],$intarray)) {
                        //HIT!
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                        }
                        $checkup = false;
                    } else {
                        //Hit a wall
                        $checkup = false;
                    }
                } else {
                    //Out of bounds
                    $checkup = false;
                }
            }
            if($checkdown) {
                $blast = $bomb[1]+$i;
                if(isset($map[$blast][$bomb[0]])) {
                    if($i == 1) {
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                        }
                    }
                    if($map[$blast][$bomb[0]] == "p"){
                        //Hits player
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                        }
                        $checkdown = false;
                    } elseif($map[$blast][$bomb[0]] == ".") {
                        //No hit
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                        }
                    } elseif($map[$blast][$bomb[0]] == "b") {
                        //Hits another bomb
                        $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                        if(isset($hitarray[$bomb[0].",".$blast]["b"])){
                            //error_log(var_export("B Already SET!", true));
                            $oldb = $hitarray[$bomb[0].",".$blast]["b"];
                            $newb = $bomb[2];
                            
                            if($oldb > $newb) {
                                $hitarray[$bomb[0].",".$blast]["b"] = $newb;
                            } elseif($oldb > $currb) {
                                $hitarray[$bomb[0].",".$blast]["b"] = $currb;
                            }
                        } else {
                            //error_log(var_export("B Not set, set it", true));
                            //error_log(var_export("Bombtime: ".$bomb[2]." - currb: $currb", true));
                            if($bomb[2] > $currb) {
                                $hitarray[$bomb[0].",".$blast]["b"] = $currb;
                            } else {
                                $hitarray[$bomb[0].",".$blast]["b"] = $bomb[2];
                            }
                        }
                        $checkdown = false;
                    } elseif(in_array($map[$blast][$bomb[0]],$intarray)) {
                        //HIT!
                        if(isset($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast])) {
                            if($hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] > $bomb[2]) {
                                $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                            }
                        } else {
                            $hitarray[$bomb[0].",".$bomb[1]][$bomb[0].",".$blast] = $bomb[2];
                        }
                        $checkdown = false;
                    } else {
                        //Hit a wall
                        $checkdown = false;
                    }
                } else {
                    //Out of bounds
                    $checkdown = false;
                }
            }
        }
    }
    foreach($hitarray as $bombpos => $bomb) {
        $lesserval = false;
        if(isset($bomb["b"])) {
            //Hit by a BOMB
            $lesserval = true;
            $hittingtime = end($bomb);
            //error_log(var_export("Pos:", true));
            //error_log(var_export($bombpos, true));
            //error_log(var_export("B val: ".$bomb["b"]." Bomb own val: ".$hittingtime, true));
            if($hittingtime < $bomb["b"]) {
                $use = $hittingtime;
                //$bomb["b"] = $use;
            } else {
                $use = $bomb["b"];
            }
        }
        foreach($bomb as $hitpos => $bombhits) {
            if($hitpos == "b") {

            } else {
                if($lesserval) {
                    if(isset($hitarray_new[$hitpos])) {
                        if($use < $hitarray_new[$hitpos]) {
                            $hitarray_new[$hitpos] = $use;
                        }
                    } else {
                        $hitarray_new[$hitpos] = $use;
                    }
                    
                } else {
                    if(isset($hitarray_new[$hitpos])) {
                        if($bombhits < $hitarray_new[$hitpos]) {
                            $hitarray_new[$hitpos] = $bombhits;
                        }
                    } else {
                        $hitarray_new[$hitpos] = $bombhits;
                    }
                }
            }
        }
    }
    return $hitarray_new;
}
function heatMap($map) {
    $intarray = array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14");
    $heatmap = array();
    //Create the heatmap of boxes

    foreach($map as $y => $row) {
        foreach($row as $x => $point) {
            $heatnum = 1;
            if(in_array($point,$intarray)) {
                //There is a box

                //Chek Up
                $checkY = $y-1;
                $checkX = $x;
                if(isset($map[$checkY][$checkX])) {
                    if(in_array($map[$checkY][$checkX],$intarray)) {
                        $heatnum++;
                    }
                }

                //Chek Up Right
                $checkY = $y-1;
                $checkX = $x+1;
                if(isset($map[$checkY][$checkX])) {
                    if(in_array($map[$checkY][$checkX],$intarray)) {
                        $heatnum++;
                    }
                }

                //Check Right
                $checkY = $y;
                $checkX = $x+1;
                if(isset($map[$checkY][$checkX])) {
                    if(in_array($map[$checkY][$checkX],$intarray)) {
                        $heatnum++;
                    }
                }

                //Chek Down Right
                $checkY = $y+1;
                $checkX = $x+1;
                if(isset($map[$checkY][$checkX])) {
                    if(in_array($map[$checkY][$checkX],$intarray)) {
                        $heatnum++;
                    }
                }

                //Check Down
                $checkY = $y+1;
                $checkX = $x;
                if(isset($map[$checkY][$checkX])) {
                    if(in_array($map[$checkY][$checkX],$intarray)) {
                        $heatnum++;
                    }
                }

                //Check Down Left
                $checkY = $y+1;
                $checkX = $x-1;
                if(isset($map[$checkY][$checkX])) {
                    if(in_array($map[$checkY][$checkX],$intarray)) {
                        $heatnum++;
                    }
                }

                //Check Left
                $checkY = $y;
                $checkX = $x-1;
                if(isset($map[$checkY][$checkX])) {
                    if(in_array($map[$checkY][$checkX],$intarray)) {
                        $heatnum++;
                    }
                }

                //Check Up Left
                $checkY = $y-1;
                $checkX = $x-1;
                if(isset($map[$checkY][$checkX])) {
                    if(in_array($map[$checkY][$checkX],$intarray)) {
                        $heatnum++;
                    }
                }

                

                //Insert the heatnum to our heatmap
                $heatmap[$y][$x] = $heatnum;
            } else {
                $heatmap[$y][$x] = $point;
            }
        }
    }
    return $heatmap;
}
function blastMapReal($map,$heatmap,$ownbombs,$enemybombs,$items,$killermode,$blastradius,$allbombspos) {

    $intarray = array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14");
    $ownbombshit = bombsHit($map,$ownbombs);

    $allbombs = array_merge($enemybombs,$ownbombs);
    $allbombshit = bombsHit($map,$allbombs);
    //error_log(var_export("Own Bombs Hit", true));
    //error_log(var_export($ownbombshit, true));
    $blastmap = array();
    //Create the blastmap of boxes
    
    foreach($map as $y => $row) {
        foreach($row as $x => $point) {

            if($point == ".") {
                
                $checkleft = true;
                $checkright = true;
                $checkup = true;
                $checkdown = true;
                $search = array($x,$y);
                $hits = 0;
                for ($i=1; $i < $blastradius; $i++) {
                    //Blast radius left - If we hit something, we don't have to look there anymore
                    $rightnext = false;
                    if($checkleft) {
                        $blast = $search[0]-$i;

                        if(isset($map[$search[1]][$blast])) {
                            if(in_array(array($blast,$search[1]),$items)) {
                                //Hit an item
                                //$hits--;
                                $checkleft = false;
                            } else {
                                if($map[$search[1]][$blast] == ".") {
                                    //No hit
                                } elseif(in_array($map[$search[1]][$blast],$intarray)) {
                                    //We check if the bomb is right next to the box or not
                                    //Left
                                    if(in_array(array($blast-1,$search[1]),$allbombspos)) {
                                        
                                        $rightnext = true;

                                    //Right
                                    } elseif(in_array(array($blast+1,$search[1]),$allbombspos)) {
                                        
                                        $rightnext = true;
                                    //Up
                                    } elseif(in_array(array($blast,$search[1]-1),$allbombspos)) {

                                        $rightnext = true;

                                    //Down
                                    } elseif(in_array(array($blast,$search[1]+1),$allbombspos)) {

                                        $rightnext = true;
                                    }
                                   
                                    
                                    if(!$rightnext) {

                                        //HIT!
                                        if($map[$search[1]][$blast] == 2) {
                                            $itembonus = 2;
                                        } elseif($map[$search[1]][$blast] == 1) {
                                            $itembonus = 1;
                                        } else {
                                            $itembonus = 0;
                                        }
                                  
                                        $hits = $hits + $itembonus + $heatmap[$search[1]][$blast];
                                        //$hits++;
                                    }
                                    $checkleft = false;
                                    
                                    
                                    //If killer mode, we need to check that we hit the enemy
                                } elseif($killermode && $map[$search[1]][$blast] == "P") {
                                        
                                        
                                    $hits++;
                                        
                                    $checkleft = false;
                                } else {
                                    //Hit a wall
                                    $checkleft = false;
                                }
                            }
                        } else {
                            //Out of bounds
                            $checkleft = false;
                        }
                    }
                    $rightnext = false;
                    if($checkright) {
                        $blast = $search[0]+$i;
                        if(isset($map[$search[1]][$blast])) {
                            if(in_array(array($blast,$search[1]),$items)) {
                                //Hit an item
                                //$hits--;
                                $checkright = false;
                            } else {
                                if($map[$search[1]][$blast] == ".") {
                                    //No hit
                                } elseif(in_array($map[$search[1]][$blast],$intarray)) {
                                    //We check if the bomb is right next to the box or not
                                    //Left
                                    if(in_array(array($blast-1,$search[1]),$allbombspos)) {
                                        
                                        $rightnext = true;

                                    //Right
                                    } elseif(in_array(array($blast+1,$search[1]),$allbombspos)) {
                                        
                                        $rightnext = true;
                                    //Up
                                    } elseif(in_array(array($blast,$search[1]-1),$allbombspos)) {

                                        $rightnext = true;

                                    //Down
                                    } elseif(in_array(array($blast,$search[1]+1),$allbombspos)) {

                                        $rightnext = true;
                                    }
                                   
                                    
                                    if(!$rightnext) {

                                        //HIT!
                                        if($map[$search[1]][$blast] == 2) {
                                            $itembonus = 2;
                                        } elseif($map[$search[1]][$blast] == 1) {
                                            $itembonus = 1;
                                        } else {
                                            $itembonus = 0;
                                        }
                                        $hits = $hits + $itembonus + $heatmap[$search[1]][$blast];
                                        //$hits++;
                                    }
                                    $checkright = false;
                                    
                                    //If killer mode, we need to check that we hit the enemy
                                } elseif($killermode && $map[$search[1]][$blast] == "P") {
                                        
                                        
                                    $hits++;
                                        
                                    $checkright = false;
                                } else {
                                    //Hit a wall
                                    $checkright = false;
                                }
                            }
                        } else {
                            //Out of bounds
                            $checkright = false;
                        }
                    }
                    $rightnext = false;
                    if($checkup) {
                        $blast = $search[1]-$i;
                        if(isset($map[$blast][$search[0]])) {
                            if(in_array(array($search[0],$blast),$items)) {
                                //Hit an item
                                //$hits--;
                                $checkup = false;
                            } else {
                                if($map[$blast][$search[0]] == ".") {
                                    //No hit
                                } elseif(in_array($map[$blast][$search[0]],$intarray)) {
                                    //We check if the bomb is right next to the box or not
                                    //Left
                                    if(in_array(array($search[0]-1,$blast),$allbombspos)) {
                                        
                                        $rightnext = true;

                                    //Right
                                    } elseif(in_array(array($search[0]+1,$blast),$allbombspos)) {
                                        
                                        $rightnext = true;
                                    //Up
                                    } elseif(in_array(array($search[0],$blast-1),$allbombspos)) {

                                        $rightnext = true;

                                    //Down
                                    } elseif(in_array(array($search[0],$blast+1),$allbombspos)) {

                                        $rightnext = true;
                                    }
                                   
                                    
                                    if(!$rightnext) {


                                        //HIT!
                                        if($map[$blast][$search[0]] == 2) {
                                            $itembonus = 2;
                                        } elseif($map[$blast][$search[0]] == 1) {
                                            $itembonus = 1;
                                        } else {
                                            $itembonus = 0;
                                        }

                                        $hits = $hits + $itembonus + $heatmap[$blast][$search[0]];
                                        //$hits++;
                                    }
                                    
                                    $checkup = false;
                                    
                                    //If killer mode, we need to check that we hit the enemy
                                } elseif($killermode && $map[$blast][$search[0]] == "P") {
                                        //error_log(var_export("BlastX: $blast - BlastY: ".$search[1]." - EnemyX: ".$enemypos[0]." - EnemyY: ".$enemypos[1], true));
                                        //error_log(var_export("Checking up if can hit enemy", true));
                                        
                                        $hits++;
                                        
                                        $checkup = false;
                                } else {
                                    //Hit a wall
                                    $checkup = false;
                                }
                            }
                        } else {
                            //Out of bounds
                            $checkup = false;
                        }
                    }
                    $rightnext = false;
                    if($checkdown) {
                        $blast = $search[1]+$i;
                        if(isset($map[$blast][$search[0]])) {
                            if(in_array(array($search[0],$blast),$items)) {
                                //Hit an item
                                //$hits--;
                                $checkdown = false;
                            } else {
                                if($map[$blast][$search[0]] == ".") {
                                    //No hit
                                } elseif(in_array($map[$blast][$search[0]],$intarray)) {

                                    //We check if the bomb is right next to the box or not
                                    //Left
                                    if(in_array(array($search[0]-1,$blast),$allbombspos)) {
                                        
                                        $rightnext = true;

                                    //Right
                                    } elseif(in_array(array($search[0]+1,$blast),$allbombspos)) {
                                        
                                        $rightnext = true;
                                    //Up
                                    } elseif(in_array(array($search[0],$blast-1),$allbombspos)) {

                                        $rightnext = true;

                                    //Down
                                    } elseif(in_array(array($search[0],$blast+1),$allbombspos)) {

                                        $rightnext = true;
                                    }
                                    //HIT!
                                    
                                    if(!$rightnext) {
                                        if($map[$blast][$search[0]] == 2) {
                                            $itembonus = 2;
                                        } elseif($map[$blast][$search[0]] == 1) {
                                            $itembonus = 1;
                                        } else {
                                            $itembonus = 0;
                                        }
                                        $hits = $hits + $itembonus + $heatmap[$blast][$search[0]];
                                            //$hits++;
                                    }
                                            
                                    $checkdown = false;
                                    
                                    
                                    //If killer mode, we need to check that we hit the enemy
                                } elseif($killermode && $map[$blast][$search[0]] == "P") {
                                        //error_log(var_export("BlastX: $blast - BlastY: ".$search[1]." - EnemyX: ".$enemypos[0]." - EnemyY: ".$enemypos[1], true));
                                        //error_log(var_export("Checking down if can hit enemy", true));
                                        
                                        $hits++;
                                        
                                        $checkdown = false;
                                } else {
                                    //Hit a wall
                                    $checkdown = false;
                                }
                            }
                        } else {
                            //Out of bounds
                            $checkdown = false;
                        }
                    }
                }
                if($hits > 0) {
                    if(isset($allbombshit[$x.",".$y])) {
                        $combomultiplier = 3;

                        $hits = $hits * $combomultiplier;
                    }
                }
                $blastmap[$y][$x] = $hits;
            } elseif($point == "X") {
                $blastmap[$y][$x] = "X";
            } else {
                $blastmap[$y][$x] = "-";
            }
        }
    }

    return $blastmap;
}
function canPlace($map,$allbombs,$blastradius,$playerpos,$enemybombshit,$bombs,$goingto = array(),$endpos = array()) {
    
    $placemap = array();
    $routes = array();
    $closed = array();
    $steps = 1;
    $bombunder = false;
    $allbombs[] = array($playerpos[0],$playerpos[1],8,$blastradius);
    $map[$playerpos[1]][$playerpos[0]] = "b";
    if(!empty($goingto)) {
        
        $playerpos = $goingto;
        $gotoloop = true;
        error_log(var_export("Map 4,0: ".$map[0][4]." Currpos: ".$playerpos[0].",".$playerpos[1], true));
    } else {
        $gotoloop = false;
    }
    //$allbombsplus = array_merge($bombs,$allbombs);
    
    $wouldhit = bombsHit($map,$allbombs);
    if(!empty($goingto)) {
        //error_log(var_export("Would Hit", true));
        //error_log(var_export($wouldhit, true));
    }
    //Current pos
    if(isset($map[$playerpos[1]][$playerpos[0]])) {
        // foreach($bombs as $bomb) {
        //     if($bomb[0] == $playerpos[0] && $bomb[1] == $playerpos[1]) {
        //         $bombunder = true;
        //     }
        // }


        

        if(!empty($goingto)) {
            $distance = 1;
            $cost = 1;
        } else {
            $distance = 0;
            $cost = 0;
        }
        $posX = $playerpos[0];
        $posY = $playerpos[1];
        $openpos = $posX.",".$posY;

        if(isset($enemybombshit[$openpos])) {
            $bombhitsin = $enemybombshit[$openpos];
        } else {
            $bombhitsin = 999;
        }
        if(isset($wouldhit[$openpos])){
            $wouldbombhitsin = $wouldhit[$openpos];
        } else {
            $wouldbombhitsin = 999;
        }

        $nextopen[$openpos] = array($posX,$posY,"G" => $cost,"H" => $distance,"F" => $distance + $cost,"P" => array($playerpos[0],$playerpos[1])); 
        if($goingto == array(8,8)) {
            error_log(var_export("Returned! $openpos , wouldbombhitsin: $wouldbombhitsin - steps: $steps", true));
        }
        if(($bombhitsin - $steps > 1 || $bombhitsin - $steps < 0) && ($wouldbombhitsin - $steps > 1 || $wouldbombhitsin - $steps < 0)) {
            //No probs
        } else {
            return false;
        }
        
    }

    while(!empty($nextopen)) {
        
        $steps++;
        //Set open array as nextopen, so we always roll through one step at a time
        $open = $nextopen;
        //Flush nextopen array
        $nextopen = array();
        foreach($open as $skey => $search) {
            //error_log(var_export("SEEARCH", true));
            //error_log(var_export($search, true));
            $closed[] = array($search[0],$search[1]);
            //Check possible squares, if we get out of the bomb path, it's a good place to put the bomb!
            //Left
            if(isset($map[$search[1]][$search[0]-1])) {
                //If left contains an open path
                
                $searchdiff = $search[0]-1;
                if(isset($enemybombshit[$searchdiff.",".$search[1]])) {
                    $bombhitsin = $enemybombshit[$searchdiff.",".$search[1]];
                } else {
                    $bombhitsin = 999;
                }
                if(isset($wouldhit[$searchdiff.",".$search[1]])){
                    $wouldbombhitsin = $wouldhit[$searchdiff.",".$search[1]];
                } else {
                    $wouldbombhitsin = 999;
                }
                if(($map[$search[1]][$search[0]-1] == "." || $map[$search[1]][$search[0]-1] == "p") && !in_array_r(array($search[0]-1,$search[1]),$closed) && ($bombhitsin - $steps > 1 || $bombhitsin - $steps < 0) && ($wouldbombhitsin - $steps > 1 || $wouldbombhitsin - $steps < 0)) {
                    if(!$gotoloop || (!isset($wouldhit[$searchdiff.",".$search[1]]) && !isset($enemybombshit[$searchdiff.",".$search[1]]))) {
                        //error_log(var_export("Returned True Left!", true));
                        if(!isset($wouldhit[$searchdiff.",".$search[1]]) && !isset($enemybombshit[$searchdiff.",".$search[1]])) {
                            if($gotoloop) {
                                
                            }
                            return true;
                        }
                        
                    }
                    
                    //error_log(var_export("LEEEFT!", true));
                    
                    $cost = $steps;
                    
                    $posX = $search[0]-1;
                    $posY = $search[1];
                    $openpos = $posX.",".$posY;
                    $distance = abs($posX - $playerpos[0]) + abs($posY - $playerpos[1]);
                    //We check if the checked square is already in the open list, if it is, we check if this route is faster.
                    if(isset($nextopen[$openpos])) {
                        if($nextopen[$openpos]["G"] > $cost) {
                            $nextopen[$openpos] = array($posX,$posY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1])); 
                        }
                    } elseif(isset($open[$openpos])) {
                        if($open[$openpos]["G"] > $cost) {
                            $nextopen[$openpos] = array($posX,$posY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1])); 
                        }
                    } else {
                        //Current route is not in the open list
                        $nextopen[$openpos] = array($posX,$posY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1])); 
                    }

                      
                }
            }
            //Right
            if(isset($map[$search[1]][$search[0]+1])) {
                //If right contains an open path
                $searchdiff = $search[0]+1;

                if(isset($enemybombshit[$searchdiff.",".$search[1]])) {
                    $bombhitsin = $enemybombshit[$searchdiff.",".$search[1]];
                } else {
                    $bombhitsin = 999;
                }
                if(isset($wouldhit[$searchdiff.",".$search[1]])){
                    $wouldbombhitsin = $wouldhit[$searchdiff.",".$search[1]];
                } else {
                    $wouldbombhitsin = 999;
                }
                
                if(($map[$search[1]][$search[0]+1] == "." || $map[$search[1]][$search[0]+1] == "p") && !in_array_r(array($search[0]+1,$search[1]),$closed) && ($bombhitsin - $steps > 1 || $bombhitsin - $steps < 0) && ($wouldbombhitsin - $steps > 1 || $wouldbombhitsin - $steps < 0)) {
                    if(!$gotoloop || (!isset($wouldhit[$searchdiff.",".$search[1]]) && !isset($enemybombshit[$searchdiff.",".$search[1]]))) {

                        if(!isset($wouldhit[$searchdiff.",".$search[1]]) && !isset($enemybombshit[$searchdiff.",".$search[1]])) {
                            if($gotoloop) {
                                error_log(var_export("Returned right!", true));
                            }
                            return true;
                        }
                        
                    }

                    $cost = $steps;
                    
                    $posX = $search[0]+1;
                    $posY = $search[1];
                    $openpos = $posX.",".$posY;
                    $distance = abs($posX - $playerpos[0]) + abs($posY - $playerpos[1]);
                    //We check if the checked square is already in the open list, if it is, we check if this route is faster.
                    if(isset($nextopen[$openpos])) {
                        if($nextopen[$openpos]["G"] > $cost) {
                            $nextopen[$openpos] = array($posX,$posY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1])); 
                        }
                    } elseif(isset($open[$openpos])) {
                        if($open[$openpos]["G"] > $cost) {
                            $nextopen[$openpos] = array($posX,$posY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1])); 
                        }
                    } else {
                        //Current route is not in the open list
                        $nextopen[$openpos] = array($posX,$posY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]));
                    }
                }
            }
            //Up
            if(isset($map[$search[1]-1][$search[0]])) {
                //If up contains an open path
                $searchdiff = $search[1]-1;

                if(isset($enemybombshit[$search[0].",".$searchdiff])) {
                    $bombhitsin = $enemybombshit[$search[0].",".$searchdiff];
                } else {
                    $bombhitsin = 999;
                }
                if(isset($wouldhit[$search[0].",".$searchdiff])){
                    $wouldbombhitsin = $wouldhit[$search[0].",".$searchdiff];
                } else {
                    $wouldbombhitsin = 999;
                }
                
                if(($map[$search[1]-1][$search[0]] == "." || $map[$search[1]-1][$search[0]] == "p") && !in_array_r(array($search[0],$search[1]-1),$closed) && ($bombhitsin - $steps > 1 || $bombhitsin - $steps < 0) && ($wouldbombhitsin - $steps > 1 || $wouldbombhitsin - $steps < 0)) {
                    if(!$gotoloop || (!isset($wouldhit[$search[0].",".$searchdiff]) && !isset($enemybombshit[$search[0].",".$searchdiff]))) {
                        //error_log(var_export("Returned True Up! wouldbombhitsin: $wouldbombhitsin - Steps: $steps", true));
                        if(!isset($wouldhit[$search[0].",".$searchdiff]) && !isset($enemybombshit[$search[0].",".$searchdiff])) {
                            if($gotoloop) {
                                error_log(var_export("Returned up!", true));
                            }
                            return true;
                        }
                        
                    }

                    $cost = $steps;
                    
                    $posX = $search[0];
                    $posY = $search[1]-1;
                    $openpos = $posX.",".$posY;
                    $distance = abs($posX - $playerpos[0]) + abs($posY - $playerpos[1]);
                    //We check if the checked square is already in the open list, if it is, we check if this route is faster.
                    if(isset($nextopen[$openpos])) {
                        if($nextopen[$openpos]["G"] > $cost) {
                            $nextopen[$openpos] = array($posX,$posY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1])); 
                        }
                    } elseif(isset($open[$openpos])) {
                        if($open[$openpos]["G"] > $cost) {
                            $nextopen[$openpos] = array($posX,$posY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1])); 
                        }
                    } else {
                        //Current route is not in the open list
                        $nextopen[$openpos] = array($posX,$posY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]));
                    }
                }
            }
            //Down
            if(isset($map[$search[1]+1][$search[0]])) {
                //If down contains an open path
                $searchdiff = $search[1]+1;

                if(isset($enemybombshit[$search[0].",".$searchdiff])) {
                    $bombhitsin = $enemybombshit[$search[0].",".$searchdiff];
                } else {
                    $bombhitsin = 999;
                }
                if(isset($wouldhit[$search[0].",".$searchdiff])){
                    $wouldbombhitsin = $wouldhit[$search[0].",".$searchdiff];
                } else {
                    $wouldbombhitsin = 999;
                }
                
                if(($map[$search[1]+1][$search[0]] == "." || $map[$search[1]+1][$search[0]] == "p") && !in_array_r(array($search[0],$search[1]+1),$closed) && ($bombhitsin - $steps > 1 || $bombhitsin - $steps < 0) && ($wouldbombhitsin - $steps > 1 || $wouldbombhitsin - $steps < 0)) {
                    // if($search[0] == 4 && $search[1] == 1) {
                    //     error_log(var_export("Down Hits in: $wouldbombhitsin - Steps: $steps", true));
                    // }
                    if(!$gotoloop || (!isset($wouldhit[$search[0].",".$searchdiff]) && !isset($enemybombshit[$search[0].",".$searchdiff]))) {
                        if(!isset($wouldhit[$search[0].",".$searchdiff]) && !isset($enemybombshit[$search[0].",".$searchdiff])) {
                            if($gotoloop) {
                                error_log(var_export("Returned down!", true));
                            }
                            return true;
                        }
                    }
                    $cost = $steps;
                    
                    $posX = $search[0];
                    $posY = $search[1]+1;
                    $openpos = $posX.",".$posY;
                    $distance = abs($posX - $playerpos[0]) + abs($posY - $playerpos[1]);
                    //We check if the checked square is already in the open list, if it is, we check if this route is faster.
                    if(isset($nextopen[$openpos])) {
                        if($nextopen[$openpos]["G"] > $cost) {
                            $nextopen[$openpos] = array($posX,$posY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1])); 
                        }
                    } elseif(isset($open[$openpos])) {
                        if($open[$openpos]["G"] > $cost) {
                            $nextopen[$openpos] = array($posX,$posY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1])); 
                        }
                    } else {
                        //Current route is not in the open list
                        $nextopen[$openpos] = array($posX,$posY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]));
                    }
                }
            }
        }
    }
    foreach($closed as $route) {
        
        if(!isset($enemybombshit[$route[0].",".$route[1]]) && !isset($wouldhit[$route[0].",".$route[1]])) {
                error_log(var_export("THIS DA ROUTE THAT FUCKS UP!", true));
                error_log(var_export($route, true));
            
                return true;
            
        }
    }
   
    //error_log(var_export("Return False", true));

    
    return false;
    
}
 function cmp($a, $b){
    if ($a == $b)
        return 0;
    return ($a['F'] < $b['F']) ? -1 : 1;
}
function hide($bomb,$playerpos,$map,$ownbomb){

    if($bomb[0] == $playerpos[0]) {
        if(isset($map[$playerpos[1]][$playerpos[0]+1]) && $map[$playerpos[1]][$playerpos[0]+1] == "." && $ownbomb[0] != $playerpos[0] + 1) {
            $gotoposX = $playerpos[0]+1;
            $gotoposY = $playerpos[1];
            error_log(var_export("Evading  bomb to: $gotoposX - $gotoposY", true));
            return array($playerpos[0] + 1,$playerpos[1]);
        } elseif(isset($map[$playerpos[1]][$playerpos[0]-1]) && $map[$playerpos[1]][$playerpos[0]-1] == "." && $ownbomb[0] != $playerpos[0] - 1) {
            $gotoposX = $playerpos[0]-1;
            $gotoposY = $playerpos[1];
            error_log(var_export("Evading  bomb to: $gotoposX - $gotoposY", true));
            return array($playerpos[0] - 1,$playerpos[1]);
        }    
    }
    if($bomb[1] == $playerpos[1]) {
        if(isset($map[$playerpos[1]+1][$playerpos[0]]) && $map[$playerpos[1]+1][$playerpos[0]] == "." && $ownbomb[1] != $playerpos[1] + 1) {
            $gotoposX = $playerpos[0];
            $gotoposY = $playerpos[1]+1;
            error_log(var_export("Evading  bomb to: $gotoposX - $gotoposY", true));
            return array($playerpos[0],$playerpos[1]+1);
        }
        elseif(isset($map[$playerpos[1]-1][$playerpos[0]]) && $map[$playerpos[1]-1][$playerpos[0]] == "." && $ownbomb[1] != $playerpos[1] - 1) {
            $gotoposX = $playerpos[0];
            $gotoposY = $playerpos[1]-1;
            error_log(var_export("Evading  bomb to: $gotoposX - $gotoposY", true));
            return array($playerpos[0],$playerpos[1]-1);
        }
    }
    return array(0,0);   
}
function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            
            return true;
        }
    }
    return false;
}
function Router($map,$heatmap,$blastmap,$bombs,$enemybombs,$player,$items,$blastradius,$killermode) {
    $intarray = array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14");
    $nobombs = false;
    //For testing purposes!!!
        //$player[2] = 2;
    //For testing purposes!!!
    $origposition = $player;

    $bombcount = $player[2];
    $newbombcount = $player[2];
    if($items == NULL) {
        $items = array();
    }
    $plantedbombs = array();
    
    //for ($i=0; $i <= $newbombcount; $i++) { 
        $steps = 0;

        $playerpos = $player;
        $bombunder = false;
        $realsteps = 0;
        $nextopen = array();
        $closed = array();
        $allbombs = array_merge($bombs,$enemybombs,$plantedbombs);
        $enemybombshit = bombsHit($map,$allbombs);
        //$ownbombshit = bombsHit($map,array_merge($bombs,$plantedbombs));


        $death = 0;
        
        if(isset($map[$playerpos[1]][$playerpos[0]])) {
            foreach($bombs as $bomb) {
                if($bomb[0] == $playerpos[0] && $bomb[1] == $playerpos[1]) {
                    error_log(var_export("BOMB UNDER MEEE!!", true));
                    $bombunder = true;
                }
            }
            
            $distance = 0;
            $cost = 0;
            $searchX = $playerpos[0];
            $searchY = $playerpos[1];
            $posvalue = $blastmap[$searchY][$searchX];
            $openpos = $searchX.",".$searchY;
            $nextopen[$openpos] = array($searchX,$searchY,"G" => $cost,"H" => $distance,"F" => $distance + $cost,"P" => array($playerpos[0],$playerpos[1]), "Blastval" => $posvalue,"Steps" => $steps); 
            
        }

        while(!empty($nextopen)) {
            $steps++;
            //Set open array as nextopen, so we always roll through one step at a time
            $open = $nextopen;
            //Flush nextopen array
            $nextopen = array();
            foreach($open as $skey => $search) {

                //Put the square in the closed array
                $closed[$search[0].",".$search[1]] = array($search[0],$search[1],"G" => $search["G"],"H" => $search["H"],"F" => $search["H"] + $search["G"], "P" => $search["P"],"Blastval" => $search["Blastval"],"Steps" => $search["Steps"]);

                //Then check the next possible squares

                //Left
                $searchX = $search[0]-1;
                $searchY = $search[1];
                $openpos = $searchX.",".$searchY;
                if(isset($map[$searchY][$searchX])) {
                    //If left contains an open path
                    if(isset($enemybombshit[$searchX.",".$searchY])) {
                        $bombhitsin = $enemybombshit[$searchX.",".$searchY];
                    } else {
                        $bombhitsin = 999;
                    }
                    if($searchX == 5 && $searchY == 6) {
                        error_log(var_export("Bombs: $bombhitsin - Steps: $steps", true));
                    }
                    if($searchX == 4 && $searchY == 6) {
                        error_log(var_export("Bombs: $bombhitsin - Steps: $steps", true));
                    }
                    if($map[$searchY][$searchX] == "." && !isset($closed[$openpos]) && ($bombhitsin - $steps > 1 || $bombhitsin - $steps < 0)) {
                        $posvalue = $blastmap[$searchY][$searchX];
                        $cost = (($steps * $newbombcount) + 5) - $posvalue;
                        //$cost = $steps * 10;
                        

                        if(in_array(array($searchX,$searchY),$items)) {
                            if($newbombcount == 0 || $bombcount == 0) {
                                $cost -= 200;
                            } else {
                                $cost -= 60;
                            }
                            
                        }

                        $distance = (abs($searchX - $playerpos[0]) + abs($searchY - $playerpos[1])) * 10;

                        //We check if the checked square is already in the open list, if it is, we check if this route is faster/better.
                        if(isset($nextopen[$openpos])) {
                            if($nextopen[$openpos]["G"] > $cost) {
                                $nextopen[$openpos] = array($searchX,$searchY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]),"Blastval" => $posvalue,"Steps" => $steps); 
                            }
                        } elseif(isset($open[$openpos])) {
                            if($open[$openpos]["G"] > $cost) {
                                $open[$openpos] = array($searchX,$searchY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]),"Blastval" => $posvalue,"Steps" => $steps); 
                            }
                        } else {
                            //Current route is not in the open list
                            $nextopen[$openpos] = array($searchX,$searchY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]),"Blastval" => $posvalue,"Steps" => $steps); 
                        }
                    }
                }

                //Right
                $searchX = $search[0]+1;
                $searchY = $search[1];
                $openpos = $searchX.",".$searchY;
                if(isset($map[$searchY][$searchX])) {
                    //If left contains an open path
                    if(isset($enemybombshit[$searchX.",".$searchY])) {
                        $bombhitsin = $enemybombshit[$searchX.",".$searchY];
                    } else {
                        $bombhitsin = 999;
                    }
                    if($searchY == 0 && $searchX == 1) {
                        error_log(var_export("Enemy bombs hits in $bombhitsin! - Steps: $steps", true));
                    }
                    if($map[$searchY][$searchX] == "." && !isset($closed[$openpos]) && ($bombhitsin - $steps > 1 || $bombhitsin - $steps < 0)) {
                        if($searchY == 0 && $searchX == 1) {
                            error_log(var_export("Enemy bombs hits in $bombhitsin! - Steps: $steps", true));
                        }
                        $posvalue = $blastmap[$searchY][$searchX];
                        $cost = (($steps * $newbombcount) + 5) - $posvalue;

                        if(in_array(array($searchX,$searchY),$items)) {
                            if($newbombcount == 0 || $bombcount == 0) {
                                $cost -= 200;
                            } else {
                                $cost -= 60;
                            }
                        }

                        $distance = (abs($searchX - $playerpos[0]) + abs($searchY - $playerpos[1])) * 10;

                        //We check if the checked square is already in the open list, if it is, we check if this route is faster/better.
                        if(isset($nextopen[$openpos])) {
                            if($nextopen[$openpos]["G"] > $cost) {
                                $nextopen[$openpos] = array($searchX,$searchY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]),"Blastval" => $posvalue,"Steps" => $steps); 
                            }
                        } elseif(isset($open[$openpos])) {
                            if($open[$openpos]["G"] > $cost) {
                                $open[$openpos] = array($searchX,$searchY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]),"Blastval" => $posvalue,"Steps" => $steps); 
                            }
                        } else {
                            //Current route is not in the open list
                            $nextopen[$openpos] = array($searchX,$searchY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]),"Blastval" => $posvalue,"Steps" => $steps); 
                        }
                    }
                }

                //Up
                $searchX = $search[0];
                $searchY = $search[1]-1;
                $openpos = $searchX.",".$searchY;
                if(isset($map[$searchY][$searchX])) {
                    //If left contains an open path
                    if(isset($enemybombshit[$searchX.",".$searchY])) {
                        $bombhitsin = $enemybombshit[$searchX.",".$searchY];
                    } else {
                        $bombhitsin = 999;
                    }
                    if($map[$searchY][$searchX] == "." && !isset($closed[$openpos]) && ($bombhitsin - $steps > 1 || $bombhitsin - $steps < 0)) {
                        $posvalue = $blastmap[$searchY][$searchX];
                        $cost = (($steps * $newbombcount) + 5) - $posvalue;

                        if(in_array(array($searchX,$searchY),$items)) {
                            if($newbombcount == 0 || $bombcount == 0) {
                                $cost -= 200;
                            } else {
                                $cost -= 60;
                            }
                        }

                        $distance = (abs($searchX - $playerpos[0]) + abs($searchY - $playerpos[1])) * 10;

                        //We check if the checked square is already in the open list, if it is, we check if this route is faster/better.
                        if(isset($nextopen[$openpos])) {
                            if($nextopen[$openpos]["G"] > $cost) {
                                $nextopen[$openpos] = array($searchX,$searchY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]),"Blastval" => $posvalue,"Steps" => $steps); 
                            }
                        } elseif(isset($open[$openpos])) {
                            if($open[$openpos]["G"] > $cost) {
                                $open[$openpos] = array($searchX,$searchY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]),"Blastval" => $posvalue,"Steps" => $steps); 
                            }
                        } else {
                            //Current route is not in the open list
                            $nextopen[$openpos] = array($searchX,$searchY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]),"Blastval" => $posvalue,"Steps" => $steps); 
                        }
                    }
                }

                //Down
                $searchX = $search[0];
                $searchY = $search[1]+1;
                $openpos = $searchX.",".$searchY;
                if(isset($map[$searchY][$searchX])) {
                    //If down contains an open path
                    if(isset($enemybombshit[$searchX.",".$searchY])) {
                        $bombhitsin = $enemybombshit[$searchX.",".$searchY];
                    } else {
                        $bombhitsin = 999;
                    }
                    //error_log(var_export("enemybomb hits in $bombhitsin - Steps: $steps", true));
                    //error_log(var_export($pos, true));
                    if($map[$searchY][$searchX] == "." && !isset($closed[$openpos]) && ($bombhitsin - $steps > 1 || $bombhitsin - $steps < 0)) {
                        $posvalue = $blastmap[$searchY][$searchX];
                        $cost = (($steps * $newbombcount) + 5) - $posvalue;
                        //error_log(var_export("Can go!", true));
                        if(in_array(array($searchX,$searchY),$items)) {
                            if($newbombcount == 0 || $bombcount == 0) {
                                $cost -= 200;
                            } else {
                                $cost -= 60;
                            }
                        }

                        $distance = (abs($searchX - $playerpos[0]) + abs($searchY - $playerpos[1])) * 10;

                        //We check if the checked square is already in the open list, if it is, we check if this route is faster/better.
                        if(isset($nextopen[$openpos])) {
                            if($nextopen[$openpos]["G"] > $cost) {
                                $nextopen[$openpos] = array($searchX,$searchY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]),"Blastval" => $posvalue,"Steps" => $steps); 
                            }
                        } elseif(isset($open[$openpos])) {
                            if($open[$openpos]["G"] > $cost) {
                                $open[$openpos] = array($searchX,$searchY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]),"Blastval" => $posvalue,"Steps" => $steps); 
                            }
                        } else {
                            //Current route is not in the open list
                            $nextopen[$openpos] = array($searchX,$searchY,"G" => $cost,"H" => $distance,"F" => $distance + $cost, "P" => array($search[0],$search[1]),"Blastval" => $posvalue,"Steps" => $steps); 
                        }
                    }
                }
            }
        }

        //error_log(var_export("Closed count".count($closed), true));
        foreach($closed as $pos => $square) {
            //error_log(var_export("Closed", true));
            //error_log(var_export($pos, true));
            
            if(isset($enemybombshit[$square[0].",".$square[1]]) && ($enemybombshit[$square[0].",".$square[1]] - $square["Steps"]) <= 3 && ($enemybombshit[$square[0].",".$square[1]] - $square["Steps"]) >= 0) {
            } elseif($bombcount == 0 && isset($enemybombshit[$square[0].",".$square[1]])) {

            } elseif($bombcount != 0 && $player[0] == $square[0] && $player[1] == $square[1]) {
                error_log(var_export("Bombcount: $bombcount - PX: ".$player[0]." PY: ".$player[1]." SX: ".$square[0]." SY:".$square[1], true));
            } else {
                
                if(!isset($totalval_compare)) {
                    if($bombcount == 0) {
                        $square["Blastval"] * 12 - $square["F"];
                    } else {
                        $square["Blastval"] * 8 - $square["F"];
                    }
                    $bestsquare = $square;
                }

                //if(canPlace($map,$blastradius,array($square[0],$square[1]),$enemybombshit,$allbombs)) {
                    $square["canplace"] = 1;
                //} else {
                    //$square["canplace"] = 0;
                //}
                //$bombcount;
                if($bombcount == 0){
                    $totalval = $square["Blastval"] * 12 - $square["F"];
                } else {
                    $totalval = $square["Blastval"] * 8 - $square["F"];
                }
                if($totalval > $totalval_compare && $square["Blastval"] != 0 && canPlace($map,$allbombs,$blastradius,array($square[0],$square[1]),$enemybombshit,$allbombs)) {
                    //error_log(var_export("Currbest = $pos - Total Value: $totalval", true));
                    //error_log(var_export($square, true));
                    $bestsquare = $square;
                    $totalval_compare = $totalval;
                }
            }

        }
        //error_log(var_export("8,8", true));
        //error_log(var_export($closed["8,8"], true));

        //error_log(var_export($bestsquare, true));
        if($bestsquare == NULL){
            $bestsquare = array(0 => $origposition[0],1 => $origposition[1],'G' => 0,'H' => 0,'F' => 0,'P' => array (0 => $origposition[0],1 => $origposition[1]),'Blastval' => 0,'Steps' => 0,'canplace' => 0);
        }
        $pos = $bestsquare[0].",".$bestsquare[1];
        $routes[$pos]["square"] = $bestsquare;
        $parent = $bestsquare["P"];
        $route = array();
        $route[] = array("goto"=>array($bestsquare[0],$bestsquare[1]),"square"=>$bestsquare);
        $route[] = array("goto"=>$parent,"square"=>$closed[$parent[0].",".$parent[1]]);
        $playerpos = array($player[0],$player[1]);
        while($parent != $playerpos) {
            $parent = $closed[$parent[0].",".$parent[1]]["P"];
            $square = $closed[$parent[0].",".$parent[1]];
            $route[] = array("goto"=>$parent,"square"=>$square);
        }
        
        for ($i=0; $i < count($route); $i++) { 
            $bombvalue = 0;
            if(isset($route[$i+1])) {
                

                    $bombvalue = 1;
                    if(isset($enemybombshit[$route[$i]["goto"][0].",".$route[$i]["goto"][1]])) {

                        $bombvalue += 80;

                    }

                    $route[$i]["square"]["placebomb"] = $bombvalue + $route[$i]["square"]["Blastval"];
                
            } else {
                $route[$i]["square"]["placebomb"] = 1;
            }
        }
        error_log(var_export("Bomb Count: $bombcount", true));
        
        for ($j=0; $j < $bombcount; $j++) {
            for ($i=0; $i < count($route); $i++) {
                if($route[$i]["square"]["placebomb"] > 0 && !isset($route[$i]["square"]["bombhere"])) {
                    if(!isset($highest_compare)) {
                        
                        $highest_compare = $route[$i]["square"]["placebomb"] * 1.8 - $route[$i]["square"]["H"];
                        
                        $highestsquare = $i;
                    }
                    $highest = $route[$i]["square"]["placebomb"] * 1.8 - $route[$i]["square"]["H"];
                    if($highest > $highest_compare) {
                        $highest_compare = $highest;
                        $highestsquare = $i;
                    }
                }
            }

            if($bombcount = 1) {
                if($route[$highestsquare]["square"]["Blastval"] != 0) {
                    $route[$highestsquare]["square"]["bombhere"] = 1;
                }
            } else {
                $route[$highestsquare]["square"]["bombhere"] = 1;
            }
            
            error_log(var_export("Highest bombingvalue Square", true));
            error_log(var_export($route[$highestsquare]["square"], true));
            unset($highest_compare);
        }
        
        
        $routes[$pos]["route"] = $route;
        // error_log(var_export("Biggest Blastval = $blastval , total cost: $totalcost , ParentX: ".$parent[0]." ParentY: ".$parent[1]." , Pos: ".$bestpos, true));
        
        
        if($newbombcount > 0) {
            //$plantedbombs[] = array($bestsquare[0],$bestsquare[1],8,$blastradius);
        }
        $newbombcount--;
        $player = array($bestsquare[0],$bestsquare[1],$newbombcount);

    //}
    error_log(var_export("All Routes", true));
    error_log(var_export($routes, true));
    return $routes;

}
fscanf(STDIN, "%d %d %d",
    $width,
    $height,
    $myId
);
$map = array();
$path = array();
// game loop
$currX = -1;
$staycourse = false;
$currY = -1;
$action = "START";
$stoppedhiding = false;
$hiding = false;
$killermode = false;
$sincebombed = 0;
$firstround = true;
$prevroute = array("route" => array("goto" => array(-1,-1)));
$blockarray = array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","X");
$intarray = array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14");
while (TRUE)
{
    $waitpls = false;
    $bombunder = false;
    $items = array();
    $itemspositions = array();
    $enemybombs = array();
    $enemies = array();
    $ownbombs = array();
    $ownbombspos = array();
    $explengtharray = array();
    $prevX = $currX;
    $prevY = $currY;
    for ($i = 0; $i < $height; $i++)
    {
        $row = stream_get_line(STDIN, $width + 1, "\n");
        for($j = 0; $j < strlen($row); $j++) {
            $map[$i][$j] = $row[$j];    
        }
        //error_log(var_export($row, true));
    }
    //error_log(var_export($map, true));
    $foundtree = false;
    
    // . = Floor
    // 0 = Box
    //error_log(var_export($map, true));
    fscanf(STDIN, "%d",
        $entities
    );
    $bomb = array(-1,-1);
    for ($i = 0; $i < $entities; $i++)
    {
        fscanf(STDIN, "%d %d %d %d %d %d",
            $entityType,
            $owner,
            $x,
            $y,
            $param1,
            $param2
        );
        if($entityType == 2) {
            $items[] = array($x,$y,$param1);    
            $itemspositions[] = array($x,$y);    
        }
        if($entityType == 0 && $owner == $myId) {
            $currX = $x;
            $currY = $y;
            $bombsnum = $param1;
            $explength = $param2;
            $player = array($x,$y,$param1);
            //$map[$y][$x] = "p";
            error_log(var_export("Blastradius: $explength", true));
        } 
        if($entityType == 0 && $owner != $myId) {
            $enemyX = $x;
            $enemyY = $y;
            $enemybombsnum = $param1;
            $enemyexplength = $param2;
            $explengtharray[$owner] = $param2;
            $enemies[] = array($x,$y,$param1,$param2);
            //Bombs don't stop in enemies, so we shouldn't put them in the map
            //$map[$y][$x] = "P";
        }
        if($entityType == 1 && $owner == $myId) {
            $bomb = array($x,$y);
            $ownbombs[] = array($x,$y,$param1,$param2);
            $ownbombspos[] = array($x,$y);
            $map[$y][$x] = "b";
        }
        if($entityType == 1 && $owner != $myId) {
            $enemybombs[] = array($x,$y,$param1,$param2);
            $enemybombspos[] = array($x,$y);
            $map[$y][$x] = "b";  
        }
    }
    if($hiding) {
        if($hidingtimer <= 0) {
            $hiding = false;
            unset($hidingtimer);
        } else {
            $goto = $goto;    
        }
    }
    //error_log(var_export("BOMBS", true));
    //error_log(var_export($enemybombs, true));
    $allbombspos = array_merge($ownbombspos,$enemybombspos);
    $heatmap = heatMap($map);
    //$blastmap = blastMap($map,array($currX,$currY),array($enemyX,$enemyY),$ownbombs,$enemybombs,$itemspositions,$explength,$enemyexplength,$bombsnum,$killermode,$enemies,$blastmap,$heatmap);
    $blastmapreal = blastMapReal($map,$heatmap,$ownbombs,$enemybombs,$itemspositions,$killermode,$explength,array_merge($ownbombspos,$enemybombspos));
    $theroute = Router($map,$heatmap,$blastmapreal,$ownbombs,$enemybombs,$player,$itemspositions,$explength,$killermode,$prevroute["route"][0]["goto"]);
    $blastmapvis = array();

    
    //error_log(var_export("Blastmap:", true));
    //error_log(var_export($blastmap, true));
    $allbombs = array_merge($ownbombs,$enemybombs);
    if($explength > $enemyexplength) {
        $sendlength = $explength;
    } else {
        $sendlength = $enemyexplength;
    }
    $enemybombshit = bombsHit($map,$allbombs);
    $bestpos = array(0,0);
    $smallestpos = 9999;
    $foundbox = false;
    $nextstep = end($path);
    if(isset($enemybombshit[$nextstep[0].",".$nextstep[1]]) && $enemybombshit[$nextstep[0].",".$nextstep[1]] <= 2) {
        error_log(var_export("Hitting next step!", true));
        if(isset($enemybombshit[$currX.",".$currY])) {
            if($enemybombshit[$currX.",".$currY] > $enemybombshit[$nextstep[0].",".$nextstep[1]]) {
                $waitpls = true;
                error_log(var_export("Current hitting takes longer, wait!!", true));
            }
        } else {
            $waitpls = true;
        }
    } else {
        error_log(var_export("Nothing hitting the next step!", true));
    }
    foreach($ownbombs as $bomb) {
        if($bomb[0] == $currX && $bomb[1] == $currY) {
            $bombunder = true;
        }
    }
    //error_log(var_export("LOLOLOLOL!", true));
    //if(!$staycourse || empty($path)){
    foreach($map as $y => $row) {
        foreach($row as $x => $point) {
            if(in_array($point,$intarray)) {
                $foundbox = true;
            }
        }
    }
    if(!$foundbox) {
        error_log(var_export("No boxes left, ACTIVATE KILLAAAAHHH!!!!", true));
        $killermode = true;
    }
    error_log(var_export("Visual Real Blastmap", true));
    foreach($blastmapreal as $y => $row) {
        $showrow = "";
        foreach($row as $x => $point) {
            if(strlen($point) == 2) {
                $showrow .= "[".$point."]";
            } else {
                $showrow .= "[ ".$point."]";
            }
        }
        error_log(var_export($showrow, true));
    }

    error_log(var_export("Heatmap", true));
    for ($i=0; $i < count($heatmap) ; $i++) {
        ksort($heatmap[$i]);
        //error_log(var_export(implode($heatmap[$i],""), true));
    }
    $gettingpath = true;

    //We need to check this again, if we were at the end of the path and generated a new one!
    $nextstep = $goto;
    
    $nextroute = reset($theroute);
    //error_log(var_export("FIRST POS OF THEROUTE!", true));
    //error_log(var_export($nextroute, true));
    $prevposarr = end($nextroute["route"]);
    array_pop($nextroute["route"]);
    $nextposarr = end($nextroute["route"]);
    $goto = $nextposarr["goto"];
    error_log(var_export("Bombs hitting!", true));
    error_log(var_export($enemybombshit, true));

    if($waitpls) {
        $goto = array($currX,$currY);
    }
    $ending = "";
    error_log(var_export("Returned:", true));
    error_log(var_export($goto, true));
    error_log(var_export("Prevroute", true));
    error_log(var_export($prevroute["route"][0]["goto"], true));
    $sincebombed++;
    if($currX == $prevroute["route"][0]["goto"][0] && $currY == $prevroute["route"][0]["goto"][1] && $blastmapreal[$currY][$currX] != "0" && !$firstround && canPlace($map,$allbombs,$explength,array($currX,$currY),$enemybombshit,$allbombs,$goto) && !$killermode) {
        $action = "BOMB";
        $ending = "Wuts happening";
    } else {
        if($prevposarr["square"]["placebomb"] == 1 && canPlace($map,$allbombs,$explength,array($currX,$currY),$enemybombshit,$allbombs,$goto) && ($blastmapreal[$currY][$currX] != 0 || $bombsnum >= 3) && !$killermode) {
            $action = "BOMB";
            $ending = "Bombhere";
            error_log(var_export($prevposarr["square"], true));
        } else {
            $action = "MOVE"; 
            //$ending = "correct";
        }
        
    }
    foreach($enemies as $enemy){
        if($enemy[0] == $currX && $enemy[1] == $currY) {
            //$action = "BOMB";
        }
    }
    $hidingtimer--;
    //error_log(var_export("Map point: ".$blastmapvis[$currY][$currX], true));
    error_log(var_export("Y: ".$currY, true));
    // Write an action using echo(). DON'T FORGET THE TRAILING \n
    // To debug (equivalent to var_dump): error_log(var_export($var, true));
    if($goto == "-") {
        $goto = array(0,0);
    }
    $prevgoto = $goto;
    $prevroute = $nextroute;
    $prevposarr = $nextposarr;
    reset($prevroute);
    $firstround = false;
    echo("$action ".$goto[0]." ".$goto[1]." ".$ending."\n");
}
?>