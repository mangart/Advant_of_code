#include <stdio.h>
#include <stdlib.h>

/* run this program using the console pauser or add your own getch, system("pause") or input loop */

int main(int argc, char *argv[]) {
	
	FILE *fptr;

	// Open a file in read mode
	char c;
	int index = 0;
	int lwh[3] = {0, 0, 0};
	int delna_vsota = 0;
	int vsota = 0;
	int min = 0;
	int smallest_perimeter = 0;
	int volume = 0;
	int ribbon = 0;
	fptr = fopen("day02_input.txt", "r");
	if(fptr == NULL) {
	  printf("Not able to open the file.");
	} 	
	while ((c = fgetc(fptr)) != EOF){
		if(c >= '0' && c <= '9'){
			lwh[index] *= 10;
			lwh[index] += c - '0'; // conversion of a character digit to int digit
		} else if(c == 'x'){
			index += 1;
		} else if(c == '\n'){
			min = lwh[0] * lwh[1];
			smallest_perimeter = 2*lwh[0] + 2*lwh[1];
			if(min > (lwh[1] * lwh[2])){
				min = lwh[1] * lwh[2];
				smallest_perimeter = 2*lwh[1] + 2*lwh[2];
			}
			if(min > (lwh[2] * lwh[0])){
				min = lwh[2] * lwh[0];
				smallest_perimeter = 2*lwh[2] + 2*lwh[0];
			}
			delna_vsota = 2*lwh[0]*lwh[1] + 2*lwh[1]*lwh[2] + 2*lwh[2]*lwh[0] + min;
			vsota += delna_vsota;
			
			// for part 2
			volume = lwh[0] * lwh[1] * lwh[2];
			ribbon += smallest_perimeter + volume;
			
			// reset for new row
			index = 0;
			lwh[0] = 0;
			lwh[1] = 0;
			lwh[2] = 0;
			
		}
	}
	min = lwh[0] * lwh[1];
	smallest_perimeter = 2*lwh[0] + 2*lwh[1];
	if(min > (lwh[1] * lwh[2])){
		min = lwh[1] * lwh[2];
		smallest_perimeter = 2*lwh[1] + 2*lwh[2];
	}
	if(min > (lwh[2] * lwh[0])){
		min = lwh[2] * lwh[0];
		smallest_perimeter = 2*lwh[1] + 2*lwh[2];
	}
	delna_vsota = 2*lwh[0]*lwh[1] + 2*lwh[1]*lwh[2] + 2*lwh[2]*lwh[0] + min;
	vsota += delna_vsota;
	
	// for part 2
	volume = lwh[0] * lwh[1] * lwh[2];
	ribbon += smallest_perimeter + volume;

    printf("Part 1 result is: %d\n",vsota);
    printf("Part 2 result is: %d\n",ribbon);
	fclose(fptr); 
	return 0;
}
