const taskService = require("../services/taskService");

exports.criar = async (req, res) => {
  try {
    const tarefa = await taskService.criar(req.body);
    res.json(tarefa);
  } catch (error) {
    res.status(500).json({ erro: "Erro ao criar tarefa" });
  }
};

exports.listar = async (req, res) => {
  try {
    const tarefas = await taskService.listar();
    res.json(tarefas);
  } catch (error) {
    res.status(500).json({ erro: "Erro ao listar tarefas" });
  }
};

exports.atualizar = async (req, res) => {
  const id = parseInt(req.params.id);
  const tarefa = await taskService.atualizar(id, req.body);
  res.json(tarefa);
};

exports.deletar = async (req, res) => {
  try {
    const id = parseInt(req.params.id);
    await taskService.deletar(id);
    res.json({ mensagem: "Tarefa deletada" });
  } catch (error) {
    res.status(500).json({ erro: "Erro ao deletar tarefa" });
  }
};