from fastapi import FastAPI, Depends
from sqlalchemy.orm import Session
from . import schemas
from .database import get_db
from .model_todos import Todo
from .service.stats_service import calculate_user_stats

app = FastAPI(title="Serviço 3 - Analisador / Contador")

@app.get("/stats/{usuarioId}", response_model=schemas.StatsResponse)
def read_stats(usuarioId: int, db: Session = Depends(get_db)):
    return calculate_user_stats(db, Todo, usuarioId)
