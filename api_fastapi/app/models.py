from sqlalchemy import Column, Integer, String, Boolean
from .database import Base

class Tarefa(Base):
    __tablename__ = "Tarefa"

    id = Column(Integer, primary_key=True, index=True)
    titulo = Column(String)
    concluida = Column(Boolean, default=False)
    usuarioId = Column("usuarioId", Integer, index=True)
