<?php

  require_once("../config/conexion.php");
  

class Ordenes extends Conectar{
/*SELECT o.paciente,o.fecha_creacion,s.nombre,s.direccion,op.nombre from orden as o inner join sucursal_optica as s on o.id_sucursal = s.id_sucursal INNER join optica as op on s.id_optica= op.id_optica*/
    ///////////GET SUCURSALES ///////////
    public function get_opticas(){
      $conectar=parent::conexion();
      parent::set_names();
      $sql="select id_optica,nombre from optica;";
      $sql=$conectar->prepare($sql);
      $sql->execute();
      return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    ///////////GET SUCURSALES ///////////
    public function get_sucursales_optica($id_optica){
      $conectar=parent::conexion();
      parent::set_names();
      $sql="select id_sucursal,direccion from sucursal_optica where id_optica=?;";
      $sql=$conectar->prepare($sql);
      $sql->bindValue(1,$id_optica);
      $sql->execute();
      return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

   	//////////////////  GET CODIGO DE ORDEN ////////////////////////

   	public function get_correlativo_orden($fecha){
    $conectar= parent::conexion();
    $fecha_act = $fecha.'%';         
    $sql= "select codigo from orden where fecha_creacion like ? order by id_orden DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$fecha_act);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  /////////////////  COMPROBAR SI EXISTE CORRELATIVO ///////////////

  public function comprobar_existe_correlativo($paciente,$date_validate){
  	$conectar = parent::conexion();
    parent::set_names();
    $fecha = $date_validate."%";
    $sql="select codigo from orden where paciente=? and fecha_creacion like ?;";
    $sql= $conectar->prepare($sql);
    $sql->bindValue(1, $paciente);
    $sql->bindValue(2, $fecha);
    $sql->execute();
    return $resultado=$sql->fetchAll();
  }

  //////////////CREAR  BARCODE///////////////////////////////////
  public function crea_barcode($codigo){
    include 'barcode.php';       
    barcode('../codigos/' . $codigo . '.png', $codigo, 50, 'horizontal', 'code128', true);
  }

  /////////////   REGISTRAR ORDEN ///////////////////////////////
   public function registrar_orden($codigo,$paciente,$observaciones,$usuario,$id_sucursal,$id_optica,$tipo_orden,$tipo_lente,$odesferasf_orden,$odcilindrosf_orden,$odejesf_orden,$oddicionf_orden,$odprismaf_orden,$oiesferasf_orden,$oicilindrosf_orden,$oiejesf_orden,$oiadicionf_orden,$oiprismaf_orden,$modelo,$marca,$color,$diseno,$horizontal,$diagonal,$vertical,$puente,$od_dist_pupilar,$od_altura_pupilar,$od_altura_oblea,$oi_dist_pupilar,$oi_altura_pupilar,$oi_altura_oblea,$trat_multifocal){

   	$conectar = parent::conexion();
    date_default_timezone_set('America/El_Salvador'); 
    $hoy = date("d-m-Y H:i:s");
    $estado = 1;

    $sql = "insert into orden values (null,?,?,?,?,?,?,?,?,?,?,?);";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
    $sql->bindValue(2, $paciente);
    $sql->bindValue(3, $observaciones);
    $sql->bindValue(4, $usuario);
    $sql->bindValue(5, $hoy);
    $sql->bindValue(6, $estado);
    $sql->bindValue(7, $id_sucursal);
    $sql->bindValue(8, $tipo_lente);
    $sql->bindValue(9, $id_optica);
    $sql->bindValue(10, $tipo_orden);
    $sql->bindValue(11, $trat_multifocal);
    $sql->execute();

/////////////////////////INSERTAR EN RX ORDEN////// 
    $sql2 ="insert into rx_orden values(?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql2 = $conectar->prepare($sql2);
    $sql2->bindValue(1, $codigo);
    $sql2->bindValue(2, $paciente);
    $sql2->bindValue(3, $odesferasf_orden);
    $sql2->bindValue(4, $odcilindrosf_orden);
    $sql2->bindValue(5, $odejesf_orden);
    $sql2->bindValue(6, $oddicionf_orden);
    $sql2->bindValue(7, $odprismaf_orden);
    $sql2->bindValue(8, $oiesferasf_orden);
    $sql2->bindValue(9, $oicilindrosf_orden);
    $sql2->bindValue(10, $oiejesf_orden);
    $sql2->bindValue(11, $oiadicionf_orden);
    $sql2->bindValue(12, $oiprismaf_orden);
    $sql2->execute();

// **INSERT INTO ARO ORDEN** //

    $sql3 = "insert into aro_orden values(?,?,?,?,?,?,?,?,?);";
    $sql3 = $conectar->prepare($sql3);
    $sql3->bindValue(1, $codigo);
    $sql3->bindValue(2, $modelo);
    $sql3->bindValue(3, $marca);
    $sql3->bindValue(4, $color);
    $sql3->bindValue(5, $diseno);
    $sql3->bindValue(6, $horizontal);
    $sql3->bindValue(7, $diagonal);
    $sql3->bindValue(8, $vertical);
    $sql3->bindValue(9, $puente);
    $sql3->execute();

//***INSERT INTO ALTURAS ORDEN ///
    $sql4 = "insert into alturas_orden values(?,?,?,?,?,?,?,?);";
    $sql4 = $conectar->prepare($sql4);
    $sql4->bindValue(1, $codigo);
    $sql4->bindValue(2, $paciente);
    $sql4->bindValue(3, $od_dist_pupilar);
    $sql4->bindValue(4, $od_altura_pupilar);
    $sql4->bindValue(5, $od_altura_oblea);
    $sql4->bindValue(6, $oi_dist_pupilar);
    $sql4->bindValue(7, $oi_altura_pupilar);
    $sql4->bindValue(8, $oi_altura_oblea);
    $sql4->execute();

}

public function get_ordenes_pendientes(){

    $conectar = parent::conexion();
    parent::set_names();

    $sql="select ord.id_orden,ord.codigo,ord.paciente,ord.estado,ord.id_sucursal,ord.id_optica,o.nombre,s.direccion from orden as ord inner join optica as o on ord.id_optica=o.id_optica inner join sucursal_optica as s on o.id_optica=s.id_optica where ord.id_sucursal=s.id_sucursal and (ord.estado='0' or ord.estado='1') order by ord.id_orden DESC;";
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $resultado=$sql->fetchAll();
}
/*SELECT p.id_paciente,c.numero_venta,p.nombres,p.empresas,p.sucursal,c.monto,c.saldo,c.monto-c.saldo as abonado,c.monto/c.plazo as cuota, c.plazo,o.fecha_inicio,o.fecha_finalizacion from pacientes as p INNER join creditos as c on p.id_paciente=c.id_paciente JOIN orden_credito as o where o.id_paciente=p.id_paciente and p.empresas like "%mpressa%" GROUP by c.numero_venta*/
////////////////////////////// DATA ORDEN ///////////////////
public function get_data_orden($codigo){
    $conectar = parent::conexion();
    parent::set_names();

    $sql = "select op.nombre AS optica,op.id_optica,s.direccion as sucursal,s.telefono,s.id_sucursal,o.paciente,o.paciente,o.observaciones,o.tipo_lente,o.trat_orden,o.codigo from orden as o inner join sucursal_optica as s on o.id_sucursal=s.id_sucursal INNER JOIN optica as op on op.id_optica= s.id_optica where o.codigo=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

}

public function get_rxfinal_oden($codigo){
  $conectar = parent::conexion();
    parent::set_names();

    $sql = "select*from rx_orden where codigo=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_altdist_orden($codigo){
  $conectar = parent::conexion();
  parent::set_names();

    $sql = "select*from alturas_orden where codigo=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_aros_orden($codigo){
  $conectar = parent::conexion();
  parent::set_names();

    $sql = "select*from aro_orden where codigo=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}


 }//Fin de la Clase
