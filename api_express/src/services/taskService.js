const { PrismaClient } = require("@prisma/client");
const prisma = new PrismaClient();
const LogIntegration = require("./LogIntegration");

exports.criar = async (data) => {
  const tarefa = await prisma.tarefa.create({
    data: {
      titulo: data.titulo,
      usuarioId: data.usuarioId || 1
    }
  });

  await LogIntegration.sendLog('Criação de Tarefa', `Tarefa criada: ${tarefa.titulo}`, data.usuarioId || 1);

  return tarefa;
};

exports.listar = async () => {
  return await prisma.tarefa.findMany();
};

exports.atualizar = async (id, data) => {
  const tarefa = await prisma.tarefa.update({
    where: { id },
    data: {
      ...(data.titulo && { titulo: data.titulo }),
      ...(data.concluida !== undefined && { concluida: data.concluida })
    }
  });

  if (data.concluida === true) {
    await LogIntegration.sendLog('Tarefa Concluída', `Tarefa finalizada: ${tarefa.titulo}`, data.usuarioId || 1);
  }

  return tarefa;
};

exports.deletar = async (id) => {
  return await prisma.tarefa.delete({
    where: { id }
  });
};