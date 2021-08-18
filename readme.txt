Laravel: 

Step 1: In p2p-task/application folder run the command composer update
Step 2: In p2p-task/application folder copy the env.example file and name it .env
Step 3: In p2p-task/application folder set your database in .env file and set JWT_TTL=9999999
Step 4: In p2p-task/application folder run the following commands
	a. php artisan key:generate
	b. php artisan jwt:secret
	c. php artisan migrate --seed
	d. php artisan serve 

Vue Js:

Step 1: In p2p-task/webapp run the following commands
	a. npm install
	b. npm run dev


