const { ethers } = require("ethers");

async function main() {
  const hash = process.argv[2];
  const rpc = process.argv[3];
  const contractAddress = process.argv[4];

  if (!hash || !rpc || !contractAddress) {
    console.log(JSON.stringify({ error: "Argumen tidak lengkap" }));
    return;
  }

  const provider = new ethers.providers.JsonRpcProvider(rpc);

  const abi = [
    "function verifyHash(bytes32 hash) public view returns (bool)"
  ];

  const contract = new ethers.Contract(contractAddress, abi, provider);

  const exists = await contract.verifyHash(hash);

  console.log(JSON.stringify({ exists }));
}

main().catch(err => {
  console.log(JSON.stringify({ error: err.message }));
});
