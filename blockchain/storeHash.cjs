const { ethers } = require("ethers");

async function main() {
  const hash = process.argv[2];
  const rpc = process.argv[3];
  const contractAddress = process.argv[4];
  const privateKey = process.argv[5];

  const provider = new ethers.providers.JsonRpcProvider(rpc);
  const wallet = new ethers.Wallet(privateKey, provider);

  const abi = [
    "function storeHash(bytes32 hash) public"
  ];

  const contract = new ethers.Contract(contractAddress, abi, wallet);
  const tx = await contract.storeHash(hash);

  const receipt = await tx.wait();

  // KIRIM 2 DATA KE LARAVEL
  console.log(JSON.stringify({
    tx_hash: receipt.transactionHash,
    block_number: receipt.blockNumber
  }));
}

main().catch(err => {
  console.error("ERROR:", err.message);
  process.exit(1);
});
