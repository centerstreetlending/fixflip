import re
import json
import os

with open('fixflip-blue-single-file-prototype.html', 'r') as f:
    content = f.read()

pages = re.findall(r'"(<!doctype html>.*?</html>\\n)"', content, re.DOTALL)
if len(pages) == 4:
    filenames = ["index.html", "add-to-loan-blue.html", "more-materials-blue.html", "contractor-login-blue.html"]
    for idx, page in enumerate(pages):
        # The string inside JS has literal \n and \". We can parse it using json.loads
        try:
            html_str = json.loads('"' + page + '"')
        except Exception as e:
            # Fallback to unicode escape if JSON fails due to strictness
            html_str = page.encode('utf-8').decode('unicode_escape')
            
        with open(filenames[idx], 'w') as f:
            f.write(html_str)
    
    os.remove('fixflip-blue-single-file-prototype.html')
    print("Success")
else:
    print(f"Found {len(pages)} pages instead of 4")
