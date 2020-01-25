<?hh

enum PaymentResult: string {
    APPROVED = 'approved';
    DECLINED = 'declined';
    ERROR = 'error';
};

echo PaymentResult::APPROVED . PHP_EOL; // "approved"


