# brainkFuck-PHP-methodChain
Implementation of BrainFUck using a PHP method chain
For some reason I felt like implementing the brainFUck language using a method chain instead of using  some lexer and parser. 
At least this gives it the speed of executing a normal PHP file plus this is way easy to do compared to dealing with lexers and parsers.

## Want to run this ?
- First make sure you have good old PHP installed. 
- Next cd into the brainFuck-PHP-methodChain dir and start the inbuilt PHP server `php -S localhost:5050`.
- Feel free to edit the `Hello World! ` example or just write your own.  

## BrainFUck Syntax
- `->shiftFwd()` or `->shiftFwd(n)` decreament the data pointer (by one or n respectively) to point to the next cell to the right.
- `->shiftBck()` or `->shiftBck(n)` 	decrement the data pointer (by one or n respectively) to point to the next cell to the left.
- `->inc()` or - `->inc(n)` increment (increase by one or n respectively) the byte at the data pointer.
- `->dec()` or - `->dec(n)` (decrease by one or n respectively) the byte at the data pointer.

- `->output()` output the byte at the data pointer. Also pass in false to mute output.
- `->input()`	accept one byte of input, storing its value in the byte at the data pointer.
- `->label('sample_label')`	if the byte at the data pointer is zero, then instead of moving the instruction pointer forward to the next command, jump it forward to the command after the matching `->jmp('sample_label')` command.
- `->jmp('sample_label')`	if the byte at the data pointer is nonzero, then instead of moving the instruction pointer forward to the next command, jump it back to the command after the matching `->label()` command.

