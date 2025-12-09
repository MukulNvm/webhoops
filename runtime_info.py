import datetime
import platform
import os

def info():
    return (
        f"Python OK\n"
        f"Time: {datetime.datetime.now()}\n"
        f"OS: {platform.system()} {platform.release()}\n"
        f"Hostname: {platform.node()}\n"
        f"User: {os.getenv('USER') or os.getenv('USERNAME')}"
    )

if __name__ == "__main__":
    print(info())
