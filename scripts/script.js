/************************
* Importação de Módulos
************************/
// Módulos do Node.js (para aplicativos no lado do servidor)
// const fs = require('fs');
// const http = require('http');
// Adicione outras importações de módulos conforme necessário

// Módulos do navegador (para aplicativos no lado do cliente)
// Exemplo: <script src="caminho_do_arquivo.js"></script>


/************************
* PROGRAME AQUI
************************/

const bitcoinPriceInReais = 190000; // Valor do Bitcoin em reais
const satoshiInBitcoin = 100000000; // Satoshis = Bitcoin

const reaisInput = document.getElementById('reaisInput');
const satoshiResult = document.getElementById('satoshiResult');

reaisInput.addEventListener('input', () => {
  const reaisAmount = parseFloat(reaisInput.value) || 0;
  
  // Reais para Bitcoin
  const bitcoinAmount = reaisAmount / bitcoinPriceInReais;
  
  // Bitcoin para Satoshis
  const satoshiAmount = bitcoinAmount * satoshiInBitcoin;
  
  satoshiResult.innerText = `${satoshiAmount.toFixed(0)} Satoshis`;
});
