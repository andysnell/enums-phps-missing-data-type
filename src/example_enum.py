from enum import Enum

class PaymentStatus(Enum):
    APPROVED = "approved"
    DECLINED = "declined"
    ERROR = "error"

    def foo(self):
        return "Hello World"

    @property
    def is_failed(self):
        return self != self.APPROVED

print(PaymentStatus.APPROVED.value) # "approved"
print(PaymentStatus.APPROVED.is_failed) # "False"
print(PaymentStatus.DECLINED.is_failed) # "True"
print(PaymentStatus.APPROVED.foo()) # "Hello, World"