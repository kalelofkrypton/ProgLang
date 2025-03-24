%{
#include <stdio.h>
#include <string.h>
%}


%%
[ \t\n]+	;
int|float|if|else|while|return	{ printf("Keyword: %s\n", yytext); }
[a-zA-Z_][a-zA-Z0-9_]*	{ printf("Identifier: %s\n", yytext); }
[0-9]+	{ printf("Number: %s\n", yytext); }
.	{ printf("Symbol: %s\n", yytext); }
%%

int main() {
	yylex();
	return 0;
}

int yywrap() {
	return 1;
}
