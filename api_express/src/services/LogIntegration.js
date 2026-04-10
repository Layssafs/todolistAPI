const axios = require('axios');

exports.sendLog = async (acao, detalhe, usuarioId = null) => {
  const logUrl = process.env.LOG_SERVICE_URL || 'http://localhost:8000/api/logs';
  try {
    const payload = { acao, detalhe };
    if (usuarioId) {
      payload.usuarioId = usuarioId;
    }
    
    await axios.post(logUrl, payload);
    console.log(`Log => ${acao} enviado ao LogService com sucesso.`);
  } catch (error) {
    console.error(`Erro ao enviar log para LogService (${acao}):`, error.message);
  }
};
