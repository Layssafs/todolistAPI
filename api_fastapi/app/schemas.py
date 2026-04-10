from pydantic import BaseModel

class StatsResponse(BaseModel):
    usuarioId: int
    total: int
    concluidas: int
    pendentes: int