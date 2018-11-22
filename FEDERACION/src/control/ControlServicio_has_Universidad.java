package control;

import model.SERVICIO_has_UNIVERSIDAD;
import java.util.List;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;
import javax.persistence.Query;

public class ControlServicio_has_Universidad {

	private EntityManagerFactory emf;
	private EntityManager em;
	private List<SERVICIO_has_UNIVERSIDAD> _Servicio_has_Universidad;
	private SERVICIO_has_UNIVERSIDAD Servicio_has_Universidad;

	public ControlServicio_has_Universidad() {
		this.emf = Persistence.createEntityManagerFactory("federacion");
		this.em = this.emf.createEntityManager();
		this._Servicio_has_Universidad = consultarServicio_has_Universidad();
		this.Servicio_has_Universidad = new SERVICIO_has_UNIVERSIDAD();
	}

	public List<SERVICIO_has_UNIVERSIDAD> consultarServicio_has_Universidad() {
		String jpql = " SELECT * FROM SERVICIO_has_UNIVERSIDAD";
		Query query = this.em.createQuery(jpql);
		List<SERVICIO_has_UNIVERSIDAD> _Servicio_has_Universidad = query.getResultList();
		return _Servicio_has_Universidad;
	}

	public void crearServicio_has_Universidad() {
		try {
			this.em.getTransaction().begin();
			this.em.persist(Servicio_has_Universidad);
			this.em.getTransaction().commit();
			this.Servicio_has_Universidad = new SERVICIO_has_UNIVERSIDAD();
		} catch (Exception e) {
			System.out.println(e);
		}
	}

	public List<SERVICIO_has_UNIVERSIDAD> get_Servicio_has_Universidad() {
		return _Servicio_has_Universidad;
	}

	public void set_Servicio_has_Universidad(List<SERVICIO_has_UNIVERSIDAD> _Servicio_has_Universidad) {
		this._Servicio_has_Universidad = _Servicio_has_Universidad;
	}

	public SERVICIO_has_UNIVERSIDAD getServicio_has_Universidad() {
		return Servicio_has_Universidad;
	}

	public void setServicio_has_Universidad(SERVICIO_has_UNIVERSIDAD Servicio_has_Universidad) {
		this.Servicio_has_Universidad = Servicio_has_Universidad;
	}

}