package com.usuario.models.dao;

import org.springframework.data.repository.CrudRepository;

import com.usuario.models.entity.Usuario;

public interface IUsuarioDao extends CrudRepository<Usuario, Long>{
	

}
 