# Fix & Flip Project Instructions

This project manages the WordPress child theme `fixflip-storefront-child` for https://fixflip.com/.

## Deployment & Verification Rules
- When Spencer requests a change and asks to deploy or update live:
  1. Update the local child theme code in this repository.
  2. Check PHP/JS/CSS syntax to ensure no syntax errors.
  3. Deploy updated files to GoDaddy production SFTP:
     - Host: `1219708.us20.ssh.myftpupload.com` (Port 22)
     - Username: `client_86a51ee4d7_1219708`
     - Remote path: `html/wp-content/themes/fixflip-storefront-child/`
  4. Commit changes with a descriptive Git message and push to GitHub.
  5. Provide Spencer with a link to verify on https://fixflip.com/.
