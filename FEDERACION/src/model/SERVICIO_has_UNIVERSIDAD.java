package model;

import java.io.Serializable;
import javax.persistence.*;


/**
 * The persistent class for the SERVICIO_has_UNIVERSIDAD database table.
 * 
 */
@Entity
@NamedQuery(name="SERVICIO_has_UNIVERSIDAD.findAll", query="SELECT s FROM SERVICIO_has_UNIVERSIDAD s")
public class SERVICIO_has_UNIVERSIDAD implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	private int SERVICIO_idSERVICIO;

	private int UNIVERSIDAD_idUNIVERSIDAD;

	public SERVICIO_has_UNIVERSIDAD() {
	}

	public int getSERVICIO_idSERVICIO() {
		return this.SERVICIO_idSERVICIO;
	}

	public void setSERVICIO_idSERVICIO(int SERVICIO_idSERVICIO) {
		this.SERVICIO_idSERVICIO = SERVICIO_idSERVICIO;
	}

	public int getUNIVERSIDAD_idUNIVERSIDAD() {
		return this.UNIVERSIDAD_idUNIVERSIDAD;
	}

	public void setUNIVERSIDAD_idUNIVERSIDAD(int UNIVERSIDAD_idUNIVERSIDAD) {
		this.UNIVERSIDAD_idUNIVERSIDAD = UNIVERSIDAD_idUNIVERSIDAD;
	}

}