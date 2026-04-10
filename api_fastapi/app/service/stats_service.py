def calculate_user_stats(db_todos, TodoModel, usuario_id: int):
    total = db_todos.query(TodoModel).filter(TodoModel.usuarioId == usuario_id).count()
    concluidas = db_todos.query(TodoModel).filter(
        TodoModel.usuarioId == usuario_id,
        TodoModel.concluida == True
    ).count()

    pendentes = total - concluidas

    return {
        "usuarioId": usuario_id,
        "total": total,
        "concluidas": concluidas,
        "pendentes": pendentes
    }