from sqlalchemy import Column, Integer, String, DateTime
from sqlalchemy.orm import declarative_base

BaseLogs = declarative_base()

class Log(BaseLogs):
    __tablename__ = "Log"

    id = Column(Integer, primary_key=True, index=True)
    action = Column(String(50))
    todoId = Column(Integer)
    message = Column(String(255))
    createdAt = Column(DateTime)