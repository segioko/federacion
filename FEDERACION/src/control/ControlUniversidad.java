package control;

import model.Universidad;

import java.util.List;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;
import javax.persistence.Query;


public class ControlUniversidad {

	private EntityManagerFactory emf;
	private EntityManager em;
	private List<Universidad> _universidad;
	private Universidad universidad;

	public ControlUniversidad() {
		this.emf = Persistence.createEntityManagerFactory("federacion");
		this.em = this.emf.createEntityManager();
		this._universidad = consultaruniversidad();
		this.universidad = new Universidad();
	}

	public List<Universidad> consultaruniversidad() {
		String jpql = " SELECT *  FROM UNIVERSIDAD";
		Query query = this.em.createQuery(jpql);
		List<Universidad> _universidad = query.getResultList();
		return _universidad;
	}

	public void crearuniversidad() {
		try {
			this.em.getTransaction().begin();
			this.em.persist(universidad);
			this.em.getTransaction().commit();
			this.universidad = new Universidad();
		} catch (Exception e) {
			System.out.println(e);
		}
	}

	public List<Universidad> get_universidad() {
		return _universidad;
	}

	public void set_universidad(List<Universidad> _universidad) {
		this._universidad = _universidad;
	}

	public Universidad getuniversidad() {
		return universidad;
	}

	public void setuniversidad(Universidad universidad) {
		this.universidad = universidad;
	}

}
