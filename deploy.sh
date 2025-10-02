#!/bin/bash

# TukioHub Production Deployment Script with Redis Caching Optimization
# This script optimizes the application for production with Redis caching

set -e

echo "🚀 Starting TukioHub deployment with Redis optimization..."

# Check if Redis is installed and running
echo "📋 Checking Redis status..."
if ! redis-cli ping > /dev/null 2>&1; then
    echo "❌ Redis is not running. Please install and start Redis first."
    echo "   Ubuntu/Debian: sudo apt install redis-server && sudo systemctl start redis"
    echo "   macOS: brew install redis && brew services start redis"
    exit 1
fi

echo "✅ Redis is running"

# Install PHP Redis extension if not present
if ! php -m | grep -q redis; then
    echo "📦 Installing PHP Redis extension..."
    if command -v apt-get > /dev/null; then
        sudo apt-get install -y php-redis
    elif command -v yum > /dev/null; then
        sudo yum install -y php-redis
    else
        echo "⚠️  Please install php-redis extension manually"
    fi
fi

# Update environment configuration
echo "⚙️  Configuring environment for production..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "📝 Created .env file from .env.example"
fi

# Update .env for Redis caching
sed -i 's/CACHE_STORE=.*/CACHE_STORE=redis/' .env
sed -i 's/SESSION_DRIVER=.*/SESSION_DRIVER=redis/' .env
sed -i 's/QUEUE_CONNECTION=.*/QUEUE_CONNECTION=redis/' .env
sed -i 's/APP_DEBUG=.*/APP_DEBUG=false/' .env
sed -i 's/LOG_LEVEL=.*/LOG_LEVEL=error/' .env

# Add Redis configuration if not present
if ! grep -q "REDIS_CACHE_DB" .env; then
    echo "" >> .env
    echo "# Redis Cache Configuration" >> .env
    echo "REDIS_CACHE_DB=1" >> .env
    echo "REDIS_SESSION_DB=2" >> .env
    echo "REDIS_QUEUE_DB=3" >> .env
    echo "CACHE_PREFIX=tukiohub_cache_" >> .env
    echo "VIEW_CACHE_ENABLED=true" >> .env
fi

echo "✅ Environment configured for Redis caching"

# Install dependencies
echo "📦 Installing dependencies..."
composer install --optimize-autoloader --no-dev --quiet
npm ci --silent

# Generate application key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    php artisan key:generate --force
    echo "🔑 Application key generated"
fi

# Run database migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force

# Clear and optimize caches
echo "🧹 Clearing existing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Warm up Redis caches
echo "🔥 Warming up Redis caches..."
php artisan cache:warm

# Build frontend assets
echo "🎨 Building frontend assets..."
npm run build

# Set proper permissions
echo "🔐 Setting file permissions..."
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

# Test Redis connection
echo "🧪 Testing Redis connection..."
php artisan tinker --execute="
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

echo 'Cache driver: ' . config('cache.default') . PHP_EOL;
echo 'Session driver: ' . config('session.driver') . PHP_EOL;
echo 'Queue driver: ' . config('queue.default') . PHP_EOL;

// Test cache
Cache::put('test_key', 'test_value', 60);
echo 'Cache test: ' . (Cache::get('test_key') === 'test_value' ? 'PASSED' : 'FAILED') . PHP_EOL;

// Test Redis connection
try {
    Redis::ping();
    echo 'Redis connection: PASSED' . PHP_EOL;
} catch (Exception \$e) {
    echo 'Redis connection: FAILED - ' . \$e->getMessage() . PHP_EOL;
}
"

echo ""
echo "🎉 TukioHub deployment completed successfully!"
echo ""
echo "📊 Performance Optimizations Applied:"
echo "   ✅ Redis caching enabled"
echo "   ✅ Redis sessions configured"
echo "   ✅ Redis queue processing"
echo "   ✅ View caching enabled"
echo "   ✅ Route caching enabled"
echo "   ✅ Config caching enabled"
echo "   ✅ Event caching enabled"
echo "   ✅ Response caching middleware"
echo "   ✅ Database query caching"
echo "   ✅ Cache warming implemented"
echo ""
echo "🚀 Your TukioHub application is now optimized and ready for production!"
echo ""
echo "📝 Next steps:"
echo "   1. Configure your web server (Nginx/Apache)"
echo "   2. Set up SSL certificate"
echo "   3. Configure Redis persistence (if needed)"
echo "   4. Set up monitoring and logging"
echo "   5. Schedule cache warming: php artisan cache:warm"
echo ""
echo "🔧 Useful commands:"
echo "   - Monitor Redis: redis-cli monitor"
echo "   - Check cache stats: php artisan cache:table"
echo "   - Clear specific cache: php artisan cache:forget key_name"
echo "   - Queue worker: php artisan queue:work redis"
echo ""
