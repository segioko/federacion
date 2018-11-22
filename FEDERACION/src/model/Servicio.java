package model;

import java.io.Serializable;
import javax.persistence.*;


/**
 * The persistent class for the SERVICIO database table.
 * 
 */
@Entity
@Table(name="SERVICIO")
@NamedQuery(name="Servicio.findAll", query="SELECT s FROM Servicio s")
public class Servicio implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	private int idSERVICIO;

	private String nombre;

	public Servicio() {
	}

	public int getIdSERVICIO() {
		return this.idSERVICIO;
	}

	public void setIdSERVICIO(int idSERVICIO) {
		this.idSERVICIO = idSERVICIO;
	}

	public String getNombre() {
		return this.nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

}