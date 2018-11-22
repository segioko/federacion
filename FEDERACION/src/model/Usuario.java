package model;

import java.io.Serializable;
import javax.persistence.*;


/**
 * The persistent class for the USUARIO database table.
 * 
 */
@Entity
@Table(name="USUARIO")
@NamedQuery(name="Usuario.findAll", query="SELECT u FROM Usuario u")
public class Usuario implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	private String idUSUARIO;

	private int UNIVERSIDAD_idUNIVERSIDAD;

	public Usuario() {
	}

	public String getIdUSUARIO() {
		return this.idUSUARIO;
	}

	public void setIdUSUARIO(String idUSUARIO) {
		this.idUSUARIO = idUSUARIO;
	}

	public int getUNIVERSIDAD_idUNIVERSIDAD() {
		return this.UNIVERSIDAD_idUNIVERSIDAD;
	}

	public void setUNIVERSIDAD_idUNIVERSIDAD(int UNIVERSIDAD_idUNIVERSIDAD) {
		this.UNIVERSIDAD_idUNIVERSIDAD = UNIVERSIDAD_idUNIVERSIDAD;
	}

	@Override
	public String toString() {
		return "Usuario [idUSUARIO=" + idUSUARIO + ", UNIVERSIDAD_idUNIVERSIDAD=" + UNIVERSIDAD_idUNIVERSIDAD + "]";
	}
	

}