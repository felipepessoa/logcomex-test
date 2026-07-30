interface ErrorMessageProps {
    message: string
    onRetry?: () => void
}
export function ErrorMessage({ message, onRetry }: ErrorMessageProps) {
    return (
        <div className="rounded-lg bg-red-50 border border-red-200 p-4 text-red-700 text-center">
            <p>{message}</p>
            {onRetry && (
                <button
                    type="button"
                    onClick={onRetry}
                    className="mt-2 text-sm underline hover:no-underline"
                >
                    Tentar novamente
                </button>
            )}
        </div>
    )
}