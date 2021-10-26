  $query = '';
  if($numero != $obra['numero']){ $query .= "UPDATE obras SET numero='{$numero}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Numero de caja");  }
  
  if($expediente != $obra['expediente']){ $query .= "UPDATE obras SET expediente = '{$expediente}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Numero de expediente");  }
  
  if($estado != $obra['estado']){ $query .= "UPDATE obras SET estado = '{$estado}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Estado de obra");  }
  
  if($observaciones != $obra['observaciones']){ $query .= "UPDATE obras SET observaciones = '{$observaciones}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Observaciones");  }
  
  if($proyectista != $obra['proyectista']){ $query .= "UPDATE obras SET proyectista = '{$proyectista}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Proyectista");  }
  
  if($titulo != $obra['nombre']){ $query .= "UPDATE obras SET nombre = '{$titulo}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Titulo de obra");  }
  
  if($descripcion != $obra['descripcion']){ $query .= "UPDATE obras SET descripcion = '{$descripcion}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Descripcion de obra");  }
  
  if($longitud != $obra['longitud']){ $query .= "UPDATE obras SET longitud = '{$longitud}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Longitud de obra");  }
  
  if($ubicacion != $obra['ubicacion']){ $query .= "UPDATE obras SET ubicacion = '{$ubicacion}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Ubicacion de obra");  }
  
  if($memoria_descriptiva != $obra['memoria_descriptiva']){ $query .= "UPDATE obras SET memoria_descriptiva = '{$memoria_descriptiva}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Memoria descriptiva de obra");  }
  
  if($memoria_descriptiva_vigente != $obra['memoria_descriptiva_vigente']){ $query .= "UPDATE obras SET memoria_descriptiva_vigente = '{$memoria_descriptiva_vigente}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Memoria descriptiva vigente de obra");  }
  
  if($proyecto_monto != $obra['proyecto_monto']){ $query .= "UPDATE obras SET proyecto_monto = '{$proyecto_monto}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Monto de presupuesto");  }
  
  if($proyecto_monto_fecha != $obra['proyecto_monto_fecha']){ $query .= "UPDATE obras SET proyecto_monto_fecha = '{$proyecto_monto_fecha}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Fecha del presupuesto");  }

  if($proyecto_plazo != $obra['proyecto_plazo']){ $query .= "UPDATE obras SET proyecto_plazo = '{$proyecto_plazo}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Plazo de obra");  }
  
  if($plazo_garantia != $obra['plazo_garantia']){ $query .= "UPDATE obras SET plazo_garantia = '{$plazo_garantia}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Plazo de garantia");  }
    
  if($contratista != $obra['contratista']){ $query .= "UPDATE obras SET contratista = '{$contratista}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Contratista adjudicada");  }
      
  if($tipo_contratacion != $obra['tipo_contratacion']){ $query .= "UPDATE obras SET tipo_contratacion = '{$tipo_contratacion}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Tipo de contratacion");  }
  
  if($aprobacion_res_fecha != $obra['aprobacion_res_fecha']){ $query .= "UPDATE obras SET aprobacion_res_fecha = '{$aprobacion_res_fecha}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Fecha de aprobacion de proyecto");  }
  
  if($aprobacion_res_num != $obra['aprobacion_res_num']){ $query .= "UPDATE obras SET aprobacion_res_num = '{$aprobacion_res_num}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Numero de resolucion de aprobacion de proyecto");  }
  
  if($adjudicacion_res_fecha != $obra['adjudicacion_res_fecha']){ $query .= "UPDATE obras SET adjudicacion_res_fecha = '{$adjudicacion_res_fecha}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Fecha de adjudicacion a empresa");  }
  
  if($adjudicacion_res_num != $obra['adjudicacion_res_num']){ $query .= "UPDATE obras SET adjudicacion_res_num = '{$adjudicacion_res_num}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Numero de resolucion de adjudicacion a empresa");  }
  
  if($tipo_financiamiento != $obra['tipo_financiamiento']){ $query .= "UPDATE obras SET tipo_financiamiento = '{$tipo_financiamiento}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Fuente de financiamiento de obra");  }
    
  if($fecha_inicio != $obra['fecha_inicio']){ $query .= "UPDATE obras SET fecha_inicio = '{$fecha_inicio}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Fecha de inicio de obra");  }
      
  if($fecha_fin != $obra['fecha_fin']){ $query .= "UPDATE obras SET fecha_fin = '{$fecha_fin}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Fecha de fin de obra");  }
        
  if($fecha_fin_no_define != $obra['fecha_fin_no_define']){ $query .= "UPDATE obras SET fecha_fin_no_define = '{$fecha_fin_no_define}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: No define fecha de finalizacion");  }
  
  if($idinspector != $obra['idinspector']){ $query .= "UPDATE obras SET idinspector = '{$idinspector}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Inspector designado a obra");  }
    
  if($contrato_fecha != $obra['contrato_fecha']){ $query .= "UPDATE obras SET contrato_fecha = '{$contrato_fecha}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Fecha de contrato");  }
      
  if($contrato_monto != $obra['contrato_monto']){ $query .= "UPDATE obras SET contrato_monto = '{$contrato_monto}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Monto de contrato");  }
              
  if($monto_vigente != $obra['monto_vigente']){ $query .= "UPDATE obras SET monto_vigente = '{$monto_vigente}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Monto de obra en vigencia");  }

  if($monto_vigente_obs != $obra['monto_vigente_obs']){ $query .= "UPDATE obras SET monto_vigente_obs = '{$monto_vigente_obs}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Observo Monto vigente");  }
              
  if($plazo_vigente != $obra['plazo_vigente']){ $query .= "UPDATE obras SET plazo_vigente = '{$plazo_vigente}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Plazo de obra en vigencia");  }

  if($plazo_vigente_obs != $obra['plazo_vigente_obs']){ $query .= "UPDATE obras SET plazo_vigente_obs = '{$plazo_vigente_obs}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Observo Plazo vigente");  }

  if($monto_redeterminado != $obra['monto_redeterminado']){ $query .= "UPDATE obras SET monto_redeterminado = '{$monto_redeterminado}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Monto de obra redeterminado");  }

  if($info_redeterminacion != $obra['info_redeterminacion']){ $query .= "UPDATE obras SET info_redeterminacion = '{$info_redeterminacion}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Informacion de redeterminacion");  }

  if($idestado_finalizado != $obra['finalizado']){ $query .= "UPDATE obras SET finalizado = '{$idestado_finalizado}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Estado de obra finalizada");  }

  if($certificado_vencimiento != $obra['certificado_vencimiento']){ $query .= "UPDATE obras SET certificado_vencimiento = '{$certificado_vencimiento}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Plazo de vencimiento de certificados segun pliegos");  }

  if($anticipo_financiero != $obra['anticipo_financiero']){ $query .= "UPDATE obras SET anticipo_financiero = '{$anticipo_financiero}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Anticipo financiero");  }

  if($valor_anticipo_financiero != $obra['valor_anticipo_financiero']){ $query .= "UPDATE obras SET valor_anticipo_financiero = '{$valor_anticipo_financiero}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Valor de anticipo financiero");  }

  if($planes_de_trabajo != $obra['idplanes_de_trabajo']){ $query .= "UPDATE obras SET idplanes_de_trabajo = '{$planes_de_trabajo}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Plan de trabajo vigente");  }

  if($cotizacion != $obra['idcotizaciones']){ $query .= "UPDATE obras SET idcotizaciones = '{$cotizacion}' WHERE idobras ='{$obra_id}';"; logs($user['id'],"obra",$obra_id,"Edito: Cotizacion vigente");  }

  $query .= "UPDATE obras SET registro_usuario = '".$user['id']."', registro_fecha = '{$registro_fecha}' WHERE idobras ='{$obra_id}';";
