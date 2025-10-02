#!/bin/bash

# Redis Installation Script for TukioHub
# This script installs Redis server and PHP Redis extension

set -e

echo "🔧 Installing Redis for TukioHub..."

# Detect OS
if [[ "$OSTYPE" == "linux-gnu"* ]]; then
    # Linux
    if command -v apt-get > /dev/null; then
        # Ubuntu/Debian
        echo "📦 Installing Redis on Ubuntu/Debian..."
        sudo apt-get update
        sudo apt-get install -y redis-server php-redis
        sudo systemctl enable redis-server
        sudo systemctl start redis-server
    elif command -v yum > /dev/null; then
        # CentOS/RHEL
        echo "📦 Installing Redis on CentOS/RHEL..."
        sudo yum install -y epel-release
        sudo yum install -y redis php-redis
        sudo systemctl enable redis
        sudo systemctl start redis
    elif command -v dnf > /dev/null; then
        # Fedora
        echo "📦 Installing Redis on Fedora..."
        sudo dnf install -y redis php-redis
        sudo systemctl enable redis
        sudo systemctl start redis
    else
        echo "❌ Unsupported Linux distribution"
        exit 1
    fi
elif [[ "$OSTYPE" == "darwin"* ]]; then
    # macOS
    echo "📦 Installing Redis on macOS..."
    if command -v brew > /dev/null; then
        brew install redis
        brew services start redis
        
        # Install PHP Redis extension
        if command -v pecl > /dev/null; then
            pecl install redis
        else
            echo "⚠️  Please install PHP Redis extension manually: pecl install redis"
        fi
    else
        echo "❌ Homebrew not found. Please install Homebrew first."
        exit 1
    fi
else
    echo "❌ Unsupported operating system: $OSTYPE"
    exit 1
fi

# Test Redis installation
echo "🧪 Testing Redis installation..."
if redis-cli ping > /dev/null 2>&1; then
    echo "✅ Redis server is running"
else
    echo "❌ Redis server is not running"
    exit 1
fi

# Test PHP Redis extension
if php -m | grep -q redis; then
    echo "✅ PHP Redis extension is installed"
else
    echo "❌ PHP Redis extension is not installed"
    echo "   Please install it manually or restart your web server"
fi

echo ""
echo "🎉 Redis installation completed!"
echo ""
echo "📝 Next steps:"
echo "   1. Update your .env file to use Redis:"
echo "      CACHE_STORE=redis"
echo "      SESSION_DRIVER=redis"
echo "      QUEUE_CONNECTION=redis"
echo ""
echo "   2. Restart your web server/PHP-FPM"
echo "   3. Run: php artisan config:clear"
echo "   4. Run: php artisan cache:clear"
echo ""
