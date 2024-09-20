const { exec } = require('child_process');
const path = require('path');

export default function handler(req, res) {
  const phpFilePath = path.join(__dirname, 'gethash.php'); // Path to your PHP file
  
  exec(`php-cgi ${phpFilePath}`, (error, stdout, stderr) => {
    if (error) {
      res.status(500).send(`Error executing PHP: ${stderr}`);
      return;
    }
    res.status(200).send(stdout); // Send the PHP output
  });
}
