%{
#include <stdio.h>
#include <stdlib.h>

int yylex(void);  // Declare manual lexer function
void yyerror(const char *s);
%}

%token NUMBER
%left '+' '-'
%left '*' '/'

%%
expression:
    expression '+' term  { printf("Addition\n"); }
  | expression '-' term  { printf("Subtraction\n"); }
  | term;

term:
    term '*' factor  { printf("Multiplication\n"); }
  | term '/' factor  { printf("Division\n"); }
  | factor;

factor:
    NUMBER  { printf("Number\n"); }
  | '(' expression ')'  { printf("Parenthesized expression\n"); };

%%

// Manual Lexer (Replaces Flex)
int yylex(void) {
    int c;
    while ((c = getchar()) == ' ' || c == '\t');  // Skip spaces

    if (c == EOF) return 0;  // End of input
    if (c == '+' || c == '-' || c == '*' || c == '/' || c == '(' || c == ')')
        return c;  // Return character as token

    if (c >= '0' && c <= '9') {  // Read a number
        ungetc(c, stdin);  // Put character back for full number reading
        int num;
        scanf("%d", &num);
        yylval = num;
        return NUMBER;
    }

    return c;  // Return any other character
}

int main() {
    printf("Enter an arithmetic expression: ");
    yyparse();
    return 0;
}

void yyerror(const char *s) {
    fprintf(stderr, "Syntax Error: %s\n", s);
}
