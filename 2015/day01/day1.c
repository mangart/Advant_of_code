#include <stdio.h>
#include <stdlib.h>

/* run this program using the console pauser or add your own getch, system("pause") or input loop */

int main(int argc, char *argv[]) {
	FILE *fptr;

	// Open a file in read mode
	char c;
	int floor = 0;
	int position = 1;
	int final_position = 0;
	fptr = fopen("day1_input.txt", "r");
	if(fptr == NULL) {
	  printf("Not able to open the file.");
	} 	
	while ((c = fgetc(fptr)) != EOF){
		if(c == '('){
			floor++;
		} else if(c == ')'){
			floor--;
		}
		if(final_position == 0 && floor == -1){
			final_position = position;
		}
		//printf("%c", c);
		position++;
	}
    printf("Part 1 result is: %d\n",floor);
    printf("Part 2 result is: %d\n",final_position);
	fclose(fptr); 
	return 0;
}
