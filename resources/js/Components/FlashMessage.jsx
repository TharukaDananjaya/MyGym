import { usePage } from "@inertiajs/react";
import React, { useEffect, useState } from "react";

const FlashMessage = () => {
    const { flash, errors } = usePage().props;
    const formErrors = Object.keys(errors).length;
    const [visible, setVisible] = useState(
        !!(flash?.error || flash?.success || formErrors > 0)
    );
    useEffect(() => {
        setVisible(!!(flash?.error || flash?.success || formErrors > 0));
    }, [flash, errors]);

    return (
        <>
            {(visible && flash?.error) ||
                (flash?.success && (
                    <div
                        className={`fixed top-0 right-0 z-50 m-4 p-4 rounded-lg shadow-lg 
        ${
            flash?.success
                ? "bg-green-100 text-green-700"
                : "bg-red-100 text-red-700"
        }`}
                    >
                        <div className="flex items-center justify-between">
                            <span className="font-semibold">
                                {flash?.success ? "Success" : "Error"}
                            </span>
                            <button
                                onClick={() => setVisible(false)}
                                className="text-lg font-bold"
                            >
                                ×
                            </button>
                        </div>
                        <p className="mt-2">{flash?.success || flash?.error}</p>
                    </div>
                ))}
            {visible && formErrors > 0 && (
                <div className="fixed top-0 right-0 z-50 m-4 p-4 rounded-lg shadow-lg bg-red-100 text-red-700">
                    <div className="flex items-center justify-between">
                        <span className="font-semibold">Error</span>
                        <button
                            onClick={() => setVisible(false)}
                            className="text-lg font-bold"
                        >
                            x
                        </button>
                    </div>
                    <div>
                        {Object.entries(errors).map(([field, message]) => (
                            <p key={field} className="text-red-600">
                                {message}
                            </p>
                        ))}
                    </div>
                </div>
            )}
        </>
    );
};

export default FlashMessage;
