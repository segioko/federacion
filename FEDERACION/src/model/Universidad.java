package model;

import java.io.Serializable;
import javax.persistence.*;


/**
 * The persistent class for the UNIVERSIDAD database table.
 * 
 */
@Entity
@Table(name="UNIVERSIDAD")
@NamedQuery(name="Universidad.findAll", query="SELECT u FROM Universidad u")
public class Universidad implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	private int idUNIVERSIDAD;

	private String nombre;

	public Universidad() {
	}

	public int getIdUNIVERSIDAD() {
		return this.idUNIVERSIDAD;
	}

	public void setIdUNIVERSIDAD(int idUNIVERSIDAD) {
		this.idUNIVERSIDAD = idUNIVERSIDAD;
	}

	public String getNombre() {
		return this.nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

}