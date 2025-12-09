import datetime

def message():
    return f"Hello from Python! Current server time is: {datetime.datetime.now()}"

if __name__ == "__main__":
    print(message())
