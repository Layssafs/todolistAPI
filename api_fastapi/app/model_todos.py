from sqlalchemy import Column, Integer, String, Boolean
from sqlalchemy.orm import declarative_base

BaseTodos = declarative_base()

class Todo(BaseTodos):
    __tablename__ = "Tarefa"

    id = Column(Integer, primary_key=True, index=True)
    titulo = Column(String(255))
    concluida = Column(Boolean, default=False)
    usuarioId = Column("usuarioId", Integer, index=True)