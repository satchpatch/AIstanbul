Webpage: https://web.njit.edu/~sq42/AIFormpage.php
Changes must be submitted to the sq42 NJIT afs account through MobaXterm before the webpage will update.

Scripts
-AIUnityHandler 
	-Used to submit questions and answers to the database
	-A new ID is generated per call, meaning, this script should only be run once the user is finished answering questions.
-ProcessingHandler
	-Used to retrieve data from the database
	-Filters queries based on the ‘question’ URL parameter. 
-AIFormpage
	-html sample form with outdated questions
	-calls AIFormpageHandler
-AIFormpageHandler 
	-packs data from the html form and submits to the database
	-not compatible with either Processing nor Unity

URL parameters:

-AIUnityHandler
0 – the first answer to be submitted to the database (1,2,3… etc can be used for subsequent answers)
Q0 – the question that corresponds to the first answer(Q1,Q2,Q3… etc can be used for subsequent questions)

-ProcessingHandler
question – used to filter the database query by question. Default value: ”Where do you live?”
