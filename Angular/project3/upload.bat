cd dist
copy .\req\* .\project\
copy .\project\index.html .\project\404.html
cd .\project\
git init
git remote add origin https://github.com/alo-learning/alo-learning.github.io
git add .
git commit -m 'launched'
git push origin master
