# brainkFuck-PHP-methodChain
Implementation of BrainFUck using a PHP method chain
For some reason I felt like implementing the brainFUck language using a method chain instead of putting together some lexers and parsers. 
At least this gives it the speed of executing a normal PHP file plus this is way easy to do compared to dealing with lexers and parsers.

## Want to run this ?
- First make sure you have good old PHP installed 
- Next cd into the brainFuck-PHP-methodChain dir and open up a simple server eg: `php -S localhost:5050`
- Feel free to edit the `Hello World! ` example or just write your own  

## BrainFUck Syntax
increment the data pointer (to point to the next cell to the right).kj
<	decrement the data pointer (to point to the next cell to the left).
+	increment (increase by one) the byte at the data pointer.
-	decrement (decrease by one) the byte at the data pointer.
.	output the byte at the data pointer.
,	accept one byte of input, storing its value in the byte at the data pointer.
[	if the byte at the data pointer is zero, then instead of moving the instruction pointer forward to the next command, jump it forward to the command after the matching ] command.
]	if the byte at the data pointer is nonzero, then instead of moving the instruction pointer forward to the next command, jump it back to the command after the matching [ command.
!	if the exclaim box is checked, allows the interpreter to use all characters to the right of the ! as program input.
