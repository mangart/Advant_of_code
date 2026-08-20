#include <stdio.h>
#include <stdlib.h>

/* run this program using the console pauser or add your own getch, system("pause") or input loop */

struct Koordinata {
	int x;
	int y;
	int count;
	struct Koordinata *Next;
};


// for deleting the allocated memory that is no longer in use
void free_list(struct Koordinata *head)
{
    struct Koordinata *current = head;

    while (current != NULL) {
        struct Koordinata *next = current->Next;
        free(current);
        current = next;
    }
}


int main(int argc, char *argv[]) {
	
	FILE *fptr;

	// Open a file in read mode
	char c;
	int x = 0;
	int y = 0;
	int dX = 0;
	int dY = 0;
	int sum = 1;  // sum is 1 because we count the initial position at the start
	struct Koordinata *head = NULL;
	struct Koordinata *iterator = NULL;
	head = (struct Koordinata *)malloc(sizeof(struct Koordinata));
	head->x = x;
	head->y = y;
	head->count = 1;
	head->Next = NULL;

	// for part2 for knowing which santa moves
	int counter = 0;
	
	// for part2 normal santa
	int x1 = 0;
	int y1 = 0;

	// for part2 robo santa
	int x2 = 0;
	int y2 = 0;
	
	int sum1 = 1;  // sum is 1, because we count the initial position at the start
	struct Koordinata *head1 = NULL;
	struct Koordinata *iterator1 = NULL;
	head1 = (struct Koordinata *)malloc(sizeof(struct Koordinata));
	head1->x = x;
	head1->y = y;
	head1->count = 1;
	head1->Next = NULL;

	
	fptr = fopen("day03_input.txt", "r");
	if(fptr == NULL) {
	  printf("Not able to open the file.");
	} 	
	while ((c = fgetc(fptr)) != EOF){
		switch(c){
			
			case '<':
				dX = -1;
				dY = 0;
				break;
				
			case '>':
				dX = 1;
				dY = 0;
				break;
			case '^':
				dX = 0;
				dY = 1;
				break;
				
			case 'v':
				dX = 0;
				dY = -1;
				break;
		}
		x = x + dX;
		y = y + dY;
		if((counter % 2) == 0){
			x1 = x1 + dX;
			y1 = y1 + dY;
		} else {
			x2 = x2 + dX;
			y2 = y2 + dY;
		}
		iterator = head;
		iterator1 = head1;
		while(iterator != NULL){
			if(iterator->x == x && iterator->y == y){
				iterator->count += 1;
				break;
			}
			if(iterator->Next == NULL){
				struct Koordinata *next = (struct Koordinata *)malloc(sizeof(struct Koordinata));
				next->x = x;
				next->y = y;
				next->count = 1;
				next->Next = NULL;
				iterator->Next = next;
				sum += 1;
				break;
			}
			iterator = iterator->Next;
		}
		
		while(iterator1 != NULL){
			if((counter % 2) == 0){
				if(iterator1->x == x1 && iterator1->y == y1){
					iterator1->count += 1;
					break;
				}
				if(iterator1->Next == NULL){
					struct Koordinata *next = (struct Koordinata *)malloc(sizeof(struct Koordinata));
					next->x = x1;
					next->y = y1;
					next->count = 1;
					next->Next = NULL;
					iterator1->Next = next;
					sum1 += 1;
					break;
				}
			} else {
				if(iterator1->x == x2 && iterator1->y == y2){
					iterator1->count += 1;
					break;
				}
				if(iterator1->Next == NULL){
					struct Koordinata *next = (struct Koordinata *)malloc(sizeof(struct Koordinata));
					next->x = x2;
					next->y = y2;
					next->count = 1;
					next->Next = NULL;
					iterator1->Next = next;
					sum1 += 1;
					break;
				}				
			}


			iterator1 = iterator1->Next;
		}
		counter += 1;
	}
	
  

    printf("Part 1 result is: %d\n",sum);
    printf("Part 2 result is: %d\n",sum1);
    iterator = NULL; 
    iterator1 = NULL;
    free_list(head);
    free_list(head1);
	fclose(fptr); 
	return 0;
}
