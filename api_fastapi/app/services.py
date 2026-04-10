from sqlalchemy.orm import Session
from .models import Tarefa

def get_user_stats(db: Session, usuarioId: int):
    total = db.query(Tarefa).filter(Tarefa.usuarioId == usuarioId).count()
    concluidas = db.query(Tarefa).filter(
        Tarefa.usuarioId == usuarioId, 
        Tarefa.concluida == True
    ).count()
    
    pendentes = total - concluidas
    
    return {
        "usuarioId": usuarioId,
        "total": total,
        "concluidas": concluidas,
        "pendentes": pendentes
    }
