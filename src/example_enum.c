#include <stdio.h>

enum payment_result {
    APPROVED,
    DECLINED,
    ERROR
};

int main()
{
    enum payment_result result;
    result = ERROR;
    printf("Result: %d", result); // "Result 2"

    return 0;
}