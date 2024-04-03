<?php
namespace app\models;
use app\interfaces\ProvasFeitasInterface;
use app\models\ProvasFeitas;

class ProvasFeitasStrategy extends ProvasFeitas implements ProvasFeitasInterface
{

  public function color($porcent): string
  {
    
    switch ($porcent){
      case $porcent < 30:
        return '<span class="badge bg-danger"> '. $porcent .'%</span>';
      case $porcent > 30 && $porcent < 60:
        return '<span class="badge bg-warning text-dark">'. $porcent .'%</span>';
      case $porcent > 60:
        return '<span class="badge bg-success">'. $porcent .'%</span>';
    }

  }


}